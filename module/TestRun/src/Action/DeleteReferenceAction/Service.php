<?php

namespace TestRun\Action\DeleteReferenceAction;

use T4webDomainInterface\ServiceInterface;

class Service implements ServiceInterface
{
    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        $referenceName = $criteria['filename'];
        return $this->removeReference($referenceName);
    }

    private function removeReference($fileName)
    {
        $referencesDir = dirname($_SERVER['DOCUMENT_ROOT']) . '/data/VisualCeption';
        $referenceFilePath = "$referencesDir/$fileName";

        if (!file_exists($referenceFilePath)) {
            return false;
        }

        $handle = fopen($referenceFilePath, 'r');
        fclose($handle);
        return unlink($referenceFilePath);
    }
}