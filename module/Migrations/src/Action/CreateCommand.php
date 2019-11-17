<?php

namespace Migrations\Action;

class CreateCommand
{
    /**
     * @var string
     */
    private $versionFolder;

    /**
     * CreateCommand constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->versionFolder = $config['version-folder'];
    }

    public function handle()
    {
        $versionNumber = date('YmdHis');
        $fileName = sprintf('Version_%s.php', $versionNumber);

        $file = new \SplFileObject($this->versionFolder . DIRECTORY_SEPARATOR . $fileName, 'w');
        $content = file_get_contents($this->versionFolder . DIRECTORY_SEPARATOR . 'Version_.php.dist');
        $content = str_replace('%version%', $versionNumber, $content);
        if ($file->fwrite($content)) {
            return $fileName;
        } else {
            throw new \RuntimeException("Can't create migration");
        }
    }
}
