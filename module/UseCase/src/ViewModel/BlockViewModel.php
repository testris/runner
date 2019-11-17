<?php

namespace UseCase\ViewModel;

use Sites\Entity\Site;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\Section;
use TestCase\Entity\TestCase;
use TestCase\Entity\TestCaseStatuses;
use TestCase\ViewModel\SectionsViewModel;
use UseCase\Entity\UseCase;
use UseCase\Entity\UseCasePriority;
use Zend\View\Model\ViewModel;

class BlockViewModel extends ViewModel
{
    /**
     * @var RepositoryInterface
     */
    protected $useCasesRepository;

    /**
     * @var RepositoryInterface
     */
    protected $testsRepository;

    /**
     * @var RepositoryInterface
     */
    protected $sitesRepository;

    /**
     * @var SectionsViewModel
     */
    protected $sectionsViewModel;

    /**
     * @var array
     */
    protected static $cases;

    /**
     * @var array
     */
    protected static $sections;

    /**
     * @var array
     */
    protected static $sitesByCases;

    /**
     * @var array
     */
    protected static $sites;

    public function __construct(
        $useCasesRepository,
        $testsRepository,
        $sitesRepository,
        $sectionsViewModel
    ) {
        $this->useCasesRepository = $useCasesRepository;
        $this->testsRepository = $testsRepository;
        $this->sitesRepository = $sitesRepository;
        $this->sectionsViewModel = $sectionsViewModel;
    }

    public function getVariable($name, $default = null)
    {
        if ($name == 'cases') {
            $priority = parent::getVariable('priority');

            $useCases = $this->fetchCases();

            return $useCases[$priority];
        }

        return parent::getVariable($name, $default);
    }

    protected function fetchCases()
    {
        if (self::$cases) {
            return self::$cases;
        }

        $allCases = $this->useCasesRepository->findMany([]);
        $cases = [
            UseCasePriority::HIGH => [],
            UseCasePriority::MEDIUM => [],
            UseCasePriority::LOW => [],
        ];

        $sections = $this->fetchSections();

        foreach ($sections as $sectionId => $section) {
            /** @var UseCase $case */
            foreach ($allCases as $case) {
                if ($sectionId == $case->getSectionId()) {
                    $cases[$case->getPriority()][$case->getSectionId()]['path'] = $section['path'];
                    $cases[$case->getPriority()][$case->getSectionId()]['cases'][] = [
                        'id' => $case->getId(),
                        'path' => $section['path'],
                        'title' => $case->getTitle(),
                    ];
                }
            }
        }

        self::$cases = $cases;

        return self::$cases;
    }

    protected function fetchSections()
    {
        if (self::$sections) {
            return self::$sections;
        }

        $sections = $this->sectionsViewModel->fetchSections();
        $tree = $this->buildTree($sections, Section::USE_CASES);
        $tree = $this->fillPath($tree, '');
        $flat = $this->sectionsViewModel->buildFlat($tree);

        foreach ($flat as $entry) {
            self::$sections[$entry['id']] = $entry;
        }

        return self::$sections;
    }

    public function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();

        /** @var Section $section */
        foreach ($elements as $element) {
            if ($element['parentId'] == $parentId) {

                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    private function fillPath(array $elements, $path)
    {
        foreach ($elements as &$element) {
            if (!isset($element['path'])) {
                if ($path) {
                    $element['path'] = $path . ' > ' . $element['name'];
                } else {
                    $element['path'] = $element['name'];
                }

            }

            if (!isset($element['children'])) {
                continue;
            }

            $element['children'] = $this->fillPath($element['children'], $element['path']);
        }

        return $elements;
    }

    public function getSitesForCase($caseId)
    {
        if (!empty(self::$sitesByCases)) {
            if (!isset(self::$sitesByCases[$caseId])) {
                self::$sitesByCases[$caseId] = [];
            }
            return self::$sitesByCases[$caseId];
        }

        /** @var TestCase[] $testCases */
        $testCases = $this->testsRepository->findMany(['status_equalTo' => TestCaseStatuses::ACTIVE]);

        self::$sitesByCases = [];

        foreach ($testCases as $testCase) {
            if (!isset(self::$sitesByCases[$testCase->getCaseId()])) {
                self::$sitesByCases[$testCase->getCaseId()] = [];
            }

            if (!in_array($this->getSiteDomain($testCase->getSiteId()), self::$sitesByCases[$testCase->getCaseId()])) {
                self::$sitesByCases[$testCase->getCaseId()][] = $this->getSiteDomain($testCase->getSiteId());
            }
        }

        if (!isset(self::$sitesByCases[$caseId])) {
            self::$sitesByCases[$caseId] = [];
        }

        return self::$sitesByCases[$caseId];
    }

    private function getSiteDomain($id)
    {
        if (empty(self::$sites)) {
            $sites = $this->sitesRepository->findMany([]);
            self::$sites = $sites->getArrayCopy();
        }

        if (array_key_exists($id, self::$sites)) {
            return self::$sites[$id]->getDomain();
        }

        return '';
    }
}