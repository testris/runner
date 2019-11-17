<?php

namespace Hosts\Action\StatusAction;

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
        $this->jenkins->enableCrumbs();
//        $this->jenkins->launchJob('deploy%20on%20test%20server', [
//            'sitedomain' => 'college-paper.org',
//            'branch' => 'release_222',
//            'subdomain' => 'release_222',
//        ]);
//            foreach ($this->jenkins->getJobs() as $job) {
//                die(var_dump($job));
//            }

        $job = $this->jenkins->getJob('deploy on test server');

        die(var_dump( $job->getLastBuild() ));

        $job = $this->jenkins->getJob("deploy%20on%20test%20server");

        /** @var Jenkins\Build $build */
        foreach ($job->getBuilds() as $build) {
            die(var_dump($build));
        }

        die(var_dump(1));
//        $this->jenkins->launchJob('deploy%20on%20test%20server', [
//            'sitedomain' => $changes['site'],
//            'branch' => $changes['branch'],
//            'subdomain' => $changes['branch'],
//        ]);

        return [
            'test' => true
        ];
    }
}