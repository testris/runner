<?php

namespace UseCase\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use UseCase\Entity\UseCase;

class CasesViewModel extends BlockViewModel
{
    public function __construct(
        $useCasesRepository,
        $sectionsViewModel
    ) {
        $this->useCasesRepository = $useCasesRepository;
        $this->sectionsViewModel = $sectionsViewModel;
    }

    public function getVariable($name, $default = null)
    {
        if ($name == 'options') {
            return $this->fetchCases();
        }

        return parent::getVariable($name, $default);
    }

    protected function fetchCases()
    {
        if (self::$cases) {
            return self::$cases;
        }

        $allCases = $this->useCasesRepository->findMany([]);
        $cases= [];

        $sections = $this->fetchSections();

        foreach ($sections as $sectionId=>$section) {
            $cases[$sectionId] = [
                'group' => $section['path'],
                'options' => [],
            ];
            /** @var UseCase $case */
            foreach ($allCases as $case) {
                if ($sectionId == $case->getSectionId()) {
                    $cases[$case->getSectionId()]['options'][$case->getId()] = $case->getTitle();
                }
            }
        }

        self::$cases = $cases;

        return self::$cases;
    }
}