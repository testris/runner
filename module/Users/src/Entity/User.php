<?php
declare(strict_types = 1);

namespace Users\Entity;

use T4webDomain\Entity;

class User extends Entity
{
    const SYSTEM_USER_ID = 1;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var boolean
     */
    protected $notifications;

    /**
     * @var boolean
     */
    protected $autoNotifications;

    /**
     * @var string
     */
    protected $name;

    public function __construct(array $data = [])
    {
        if (isset($data['notifications'])) {
            $data['notifications'] = (bool)$data['notifications'];
        }
        if (isset($data['autoNotifications'])) {
            $data['autoNotifications'] = (bool)$data['autoNotifications'];
        }
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return boolean
     */
    public function canReceiveNotifications(): bool
    {
        return $this->notifications;
    }

    /**
     * @return boolean
     */
    public function isSystem(): bool
    {
        $isSystem = $this->getId() == static::SYSTEM_USER_ID;
        return $isSystem;
    }
}
