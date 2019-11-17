<?php

namespace TestResult\Entity;

use ArrayObject;

class TestResultCollection extends ArrayObject
{
    public function rebuildByCaseId()
    {
        $data = $this->getArrayCopy();

        $result = new self();
        /** @var TestResult $item */
        foreach ($data as $item) {
            $result->offsetSet($item->getCaseId(), $item);
        }

        return $result;
    }

    public function getCaseIds()
    {
        $caseIds = array_keys($this->rebuildByCaseId()->getArrayCopy());
        return $caseIds;
    }
}
