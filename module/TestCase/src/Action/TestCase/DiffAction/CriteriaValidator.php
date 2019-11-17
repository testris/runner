<?php

namespace TestCase\Action\TestCase\DiffAction;

use T4web\Crud\Validator\BaseFilter;

class CriteriaValidator extends BaseFilter
{
    public function getValid()
    {
        $valid = parent::getValid();

        if (empty($valid['limit'])) {
            $valid['limit'] = 200;
        }
        if (empty($valid['order'])) {
            $valid['order'] = 'updated DESC';
        }

        return $valid;
    }
}