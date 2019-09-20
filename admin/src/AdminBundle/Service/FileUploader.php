<?php
namespace AdminBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file,$date,$type)
    {
        $fileName = $file->getClientOriginalName();
        $file->move($this->getTargetDir(), $date.'_'.$type.'_'.$fileName);

        return $date.'_'.$type.'_'.$fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
?>