<?php

namespace Sites\Action\ListAction;

use T4web\Crud\Validator\BaseFilter;
use Zend\InputFilter\Input;

class CriteriaValidator extends BaseFilter
{
    public function __construct()
    {
        parent::__construct();

        $order = new Input('order');
        $order->setRequired(false);
        $this->inputFilter->add($order);

        $limit = new Input('limit');
        $limit->setRequired(false);
        $this->inputFilter->add($limit);

        $page = new Input('page');
        $page->setRequired(false);
        $this->inputFilter->add($page);
    }

    public function getValid()
    {
        $valid = parent::getValid();

        if (empty($valid['order'])) {
            $valid['order'] = 'domain ASC';
        }

        if (empty($valid['limit'])) {
            $valid['limit'] = 20;
        }

        return $valid;
    }
}
