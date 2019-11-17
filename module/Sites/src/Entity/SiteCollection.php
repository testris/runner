<?php

namespace Sites\Entity;

use ArrayObject;

class SiteCollection extends ArrayObject
{
    public function getSiteDomains()
    {
        $result = array_keys($this->rebuildBySiteDomain()->getArrayCopy());
        return $result;
    }

    public function getSiteIds()
    {
        $result = array_keys($this->getArrayCopy());
        return $result;
    }

    private function rebuildBySiteDomain()
    {
        $data = $this->getArrayCopy();

        $result = new self();
        /** @var Site $item */
        foreach ($data as $item) {
            $result->offsetSet($item->getDomain(), $item);
        }

        return $result;
    }
}
