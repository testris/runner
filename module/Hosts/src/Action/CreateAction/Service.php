<?php

namespace Hosts\Action\CreateAction;

use Hosts\Entity\Environment;
use Hosts\Entity\Hosts;
use Jenkins\Jenkins;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $hostsRepository;

    /**
     * @var Jenkins
     */
    private $jenkins;

    /**
     * Service constructor.
     * @param RepositoryInterface $hostsRepository
     * @param Jenkins $jenkins
     */
    public function __construct(
        RepositoryInterface $hostsRepository,
        Jenkins $jenkins
    ) {
        $this->jenkins = $jenkins;
        $this->hostsRepository = $hostsRepository;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        $jobName = Environment::getJobNameByType($changes['environment']);

        $this->jenkins->enableCrumbs();
        $this->jenkins->launchJob($jobName, [
            'sitedomain' => $changes['site'],
            'branch' => $changes['branch'],
            'subdomain' => $changes['branch'],
        ]);

        $this->hostsRepository->add(new Hosts($changes));
    }
}