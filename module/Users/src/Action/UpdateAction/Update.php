<?php

namespace Users\Action\UpdateAction;

use T4webDomainInterface\ServiceInterface;

class Update implements ServiceInterface
{
    /**
     * @var ServiceInterface
     */
    protected $update;

    /**
     * @param ServiceInterface $update
     */
    public function __construct(ServiceInterface $update)
    {
        $this->update = $update;
    }

    public function handle($criteria, $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->update->handle($criteria, $data);
    }
}
