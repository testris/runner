<?php

namespace Sites\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use Sites\Entity\Site;
use Zend\View\Model\ViewModel;

class SitesViewModel extends ViewModel
{
    /**
     * @var RepositoryInterface
     */
    protected $sitesRepository;

    public function __construct(RepositoryInterface $sitesRepository)
    {
        $this->sitesRepository = $sitesRepository;
    }

    public function getVariable($name, $default = null)
    {
        if ($name == 'options') {
            return $this->fetchSites();
        }

        return parent::getVariable($name, $default);
    }

    protected function fetchSites()
    {
        $sites = $this->sitesRepository->findMany([]);
        $options = [];

        /** @var Site $site */
        foreach ($sites as $site) {
            $options[$site->getId()] = $site->getDomain();
        }

        return $options;
    }
}