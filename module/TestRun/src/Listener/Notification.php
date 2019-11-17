<?php
declare(strict_types=1);

namespace TestRun\Listener;

use Email\Sender;
use Email\Template;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestRun\Entity\TestRun;
use Users\Entity\User;
use Zend\EventManager\EventInterface;

class Notification
{
    /**
     * @var Sender
     */
    private $sender;
    /**
     * @var RepositoryInterface
     */
    private $userRepository;
    /**
     * @var string
     */
    private $serverUrl;

    /**
     * @param Sender $sender
     */
    public function __construct(Sender $sender, RepositoryInterface $userRepository, string $serverUrl)
    {
        $this->sender = $sender;
        $this->userRepository = $userRepository;
        $this->serverUrl = $serverUrl;
    }

    public function __invoke(EventInterface $e)
    {
        /** @var TestRun $testRun */
        $testRun = $e->getParam('testRun');

        $recipients = $this->getRecipients($testRun);

        if (!empty($recipients)) {
            $this->sender->send(
                $recipients,
                $this->getTestRunTemplateId($testRun),
                [
                    'name' => $testRun->getTitle(),
                    'runLink' => "{$this->serverUrl}/test-runs/result/{$testRun->getId()}/view",
                ]
            );
        }
    }

    /**
     * @param TestRun $testRun
     * @return array
     */
    public function getRecipients(TestRun $testRun): array
    {
        $emails = [];

        /** @var User $initUser */
        $initUser = $this->userRepository->find([
            'id_equalTo' => $testRun->getRunBy()
        ]);

        // system run
        if ($initUser->isSystem()) {
            $autoNotificationUsers = $this->userRepository->findMany(
                [
                    'autoNotifications_equalTo' => true,
                    'notifications_equalTo' => true,
                ]
            );
            foreach ($autoNotificationUsers as $user) {
                $emails[] = $user->getEmail();
            }
        } else {
            if ($initUser->canReceiveNotifications()) {
                $emails[] = $initUser->getEmail();
            }
        }
        return $emails;
    }

    public function getTestRunTemplateId(TestRun $testRun)
    {
        if ($testRun->isPassed()) {
            return Template::RUN_PASSED;
        } else {
            return Template::RUN_FAILED;
        }
    }
}