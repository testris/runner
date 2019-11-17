<?php

namespace TestCase\Entity;

use ArrayObject;

class TestCaseCollection extends ArrayObject
{
    public function getSiteIds()
    {
        $result = array_keys($this->rebuildBySiteId()->getArrayCopy());
        return $result;
    }

    private function rebuildBySiteId()
    {
        $data = $this->getArrayCopy();

        $result = new self();
        /** @var TestCase $item */
        foreach ($data as $item) {
            $result->offsetSet($item->getSiteId(), $item);
        }

        return $result;
    }
}
