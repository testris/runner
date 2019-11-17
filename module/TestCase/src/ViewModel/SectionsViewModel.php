<?php

namespace TestCase\ViewModel;

use Sites\Entity\Site;
use Sites\Entity\SiteType;
use Zend\View\Model\ViewModel;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\Section;
use TestCase\Entity\TestCase;

class SectionsViewModel extends ViewModel
{
    /**
     * @var RepositoryInterface
     */
    protected $sectionsRepository;

    /**
     * @var RepositoryInterface
     */
    protected $sitesRepository;

    /**
     * @var array
     */
    private static $cache;

    /**
     * @var TestCase[]
     */
    private static $casesCache;

    /**
     * @var Section[]
     */
    private static $sectionsCache;

    /**
     * SectionsViewModel constructor.
     * @param RepositoryInterface $sectionsRepository
     * @param RepositoryInterface $sitesRepository
     */
    public function __construct(
        RepositoryInterface $sectionsRepository,
        RepositoryInterface $sitesRepository
    ) {
        $this->sectionsRepository = $sectionsRepository;
        $this->sitesRepository = $sitesRepository;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        if ($name == 'options') {
            if (self::$cache) {
                return self::$cache;
            }

            $sections = $this->fetchSections();
            $options = [];

            $additionalOptions = $this->getVariable('additionalOptions');
            if (is_array($additionalOptions)) {
                $options = $additionalOptions;
            }

            $tree = $this->buildTree($sections, $this->getVariable('parentId', 0));
            $flat = $this->buildFlat($tree);

            $depthPrefix = '|&nbsp;&nbsp;&nbsp;';
            foreach ($flat as $element) {
                $options[$element['id']] = str_repeat($depthPrefix, $element['depth']) . $element['name'];
            }

            self::$cache = $options;

            return $options;
        }

        return parent::getVariable($name, $default);
    }

    public function fetchSections()
    {
        if (self::$sectionsCache) {
            return self::$sectionsCache;
        }

        $sections = $this->sectionsRepository->findMany(['limit' => 999]);

        self::$sectionsCache = [];
        foreach ($sections as $section) {
            self::$sectionsCache[] = $section->extract();
        }

        return self::$sectionsCache;
    }

    public function getSectionTree()
    {
        $sections = $this->sectionsRepository->findMany([]);

        $elements = [];
        foreach ($sections as $section) {
            $elements[] = $section->extract();
        }

        $tree = $this->buildTree($elements, $this->getVariable('parentId', 0));

        $sectionTree = $tree;
        if ($this->getVariable('parentId', 0) != Section::USE_CASES) {
            $useCases = $sectionTree[Section::USE_CASES];
            unset($sectionTree[Section::USE_CASES]);


            foreach ($this->getSitesByType(SiteType::ESSAY) as $site) {
                $children = $useCases['children'][Section::ESSAY]['children'];

                foreach ($children as &$child) {
                    $child['parentId'] = $site->getId() + 10000;
                }

                $sectionTree[$site->getId() + 10000] = [
                    'parentId' => 0,
                    'name' => $site->getDomain(),
                    'siteId' => $site->getId(),
                    'id' => Section::ESSAY,
                    'depth' => 0,
                    'children' => $children,
                ];
            }
            
            foreach ($this->getSitesByType(SiteType::RESUME) as $site) {
                $children = $useCases['children'][Section::RESUME]['children'];

                foreach ($children as &$child) {
                    $child['parentId'] = $site->getId() + 10000;
                }

                $sectionTree[$site->getId() + 10000] = [
                    'parentId' => 0,
                    'name' => $site->getDomain(),
                    'siteId' => $site->getId(),
                    'id' => Section::RESUME,
                    'depth' => 0,
                    'children' => $children,
                ];
            }

            foreach ($this->getSitesByType(SiteType::WRITER) as $site) {
                $children = $useCases['children'][Section::WRITER]['children'];

                foreach ($children as &$child) {
                    $child['parentId'] = $site->getId() + 10000;
                }

                $sectionTree[$site->getId() + 10000] = [
                    'parentId' => 0,
                    'name' => $site->getDomain(),
                    'siteId' => $site->getId(),
                    'id' => Section::WRITER,
                    'depth' => 0,
                    'children' => $children,
                ];
            }

            foreach ($this->getSitesByType(SiteType::CRM) as $site) {
                $children = $useCases['children'][Section::CRM]['children'];

                foreach ($children as &$child) {
                    $child['parentId'] = $site->getId() + 10000;
                }

                $sectionTree[$site->getId() + 10000] = [
                    'parentId' => 0,
                    'name' => $site->getDomain(),
                    'siteId' => $site->getId(),
                    'id' => Section::CRM,
                    'depth' => 0,
                    'children' => $children,
                ];
            }
        }

        return $sectionTree;
    }

    /**
     * @param int $sectionId
     * @param int|null $siteId
     * @return TestCase[]
     */
    public function getCasesBySectionId($sectionId, $siteId = null)
    {
        if (empty(self::$casesCache)) {
            self::$casesCache = $this->getAllCases();
        }

        $result = [];
        /** @var TestCase $testCase */
        foreach (self::$casesCache as $testCase) {
            if ($testCase->getSectionId() != $sectionId) {
                continue;
            }

            if (is_null($siteId)) {
                $result[] = $testCase;
            } else {
                if ($testCase->getSiteId() == $siteId) {
                    $result[] = $testCase;
                } else {
                    continue;
                }
            }
        }

        return $result;
    }

    /**
     * @return TestCase[]
     */
    protected function getAllCases()
    {
        return parent::getVariable('result');
    }

    public function buildTree(array $elements, $parentId = 0, $depth = 0) {
        $branch = array();

        /** @var Section $section */
        foreach ($elements as $element) {
            if ($element['parentId'] == $parentId) {
                $element['depth'] = $depth;
                $element['children'] = [];
                $children = $this->buildTree($elements, $element['id'], $depth + 1);
                if ($children) {
                    foreach ($children as &$child) {
                        $child['depth'] = $element['depth'] + 1;
                    }
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
            }
        }

        return $branch;
    }

    public function buildFlat($tree) {
        $result = array();
        foreach($tree as $row) {
            if (!isset($row['children'])) {
                $result[] = $row;
                continue;
            }

            $children = $row['children'];
            unset($row['children']);
            $result[] = $row;
            if (count($children) > 0) {
                $result = array_merge($result, $this->buildFlat($children));
            }
        }
        return $result;
    }

    /**
     * @param int $type
     * @return Site
     */
    private function getSitesByType(int $type)
    {
        /** @var Site $sites */
        $sites = $this->sitesRepository->findMany([
            'type_equalTo' => $type,
        ]);

        return $sites;
    }

    /**
     * @param int $id
     * @return Site
     */
    public function getSite(int $id)
    {
        /** @var Site $site */
        $site = $this->sitesRepository->findById($id);

        return $site;
    }
}