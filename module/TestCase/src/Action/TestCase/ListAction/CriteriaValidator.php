<?php

namespace TestCase\Action\TestCase\ListAction;

use T4web\Crud\Validator\BaseFilter;

class CriteriaValidator extends BaseFilter
{
    public function getValid()
    {
        $valid = parent::getValid();

        if (empty($valid['limit'])) {
            $valid['limit'] = 9999;
        }

        return $valid;
    }

}