<?php

namespace Users\Action\CreateAction;

use T4webDomainInterface\ServiceInterface;

class Creator implements ServiceInterface
{
    /**
     * @var ServiceInterface
     */
    protected $creator;

    /**
     * @param ServiceInterface $creator
     */
    public function __construct(ServiceInterface $creator)
    {
        $this->creator = $creator;
    }

    public function handle($criteria, $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->creator->handle($criteria, $data);
    }
}
