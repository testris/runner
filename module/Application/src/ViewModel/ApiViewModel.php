<?php

namespace Application\ViewModel;

use ArrayObject;
use T4webDomainInterface\EntityInterface;
use Zend\View\Model\JsonModel;

class ApiViewModel extends JsonModel
{
    public function prepare()
    {
        if (!empty($this->getVariable('changesErrors'))
            || !empty($this->getVariable('criteriaErrors'))) {
            return [
                'changesErrors' => $this->getVariable('changesErrors'),
                'criteriaErrors' => $this->getVariable('criteriaErrors')
            ];
        }

        $result = $this->getVariable('result');

        if ($result instanceof ArrayObject) {
            $content = ['result' => [],];

            foreach ($result as $entity) {
                $content['result'][] = $entity->extract();
            }
        } elseif($result instanceof EntityInterface){
            $content = [
                'result' => $result->extract(),
            ];
        } else {
            $content = $result;
        }

        return $content;
    }

    public function serialize()
    {
        return json_encode($this->prepare());
    }
}
