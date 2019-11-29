<?php

namespace Email\Action;

use Email\Sender;
use Email\Template;
use T4webDomainInterface\ServiceInterface;

class TestEmailService implements ServiceInterface
{
    /**
     * @var Sender
     */
    private $sender;

    /**
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        $this->sender->send(
            'user.default@runner.com',
            Template::RUN_FAILED,
            ['name' => 'Nightly build 12 Sep, 18']
        );

        die(var_dump('done.'));
    }
}