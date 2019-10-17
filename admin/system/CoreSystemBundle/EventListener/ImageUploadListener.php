<?php

namespace CoreSystemBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;

use CoreSystemBundle\Service\FileUploader;

use CoreSystemBundle\Entity\Page;
use CoreSystemBundle\Entity\Actuality;
use CoreSystemBundle\Entity\Event;
use CoreSystemBundle\Entity\Publication;
use CoreSystemBundle\Entity\PublicationCategory;
use CoreSystemBundle\Entity\Settings;

use CoreSystemBundle\Entity\Press;

use ContentElementsManagementSystemBundle\Entity\BlocTeamMember;

use MediaBundle\Entity\Image;

class ImageUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
      
        $entity = $args->getEntity();
      

        $this->uploadFile($entity);

    }

    private function uploadFile($entity)
    {   
        $date = new \DateTime("now");
        $date = $date->format('Y-m-d_H-i-s');
        

        if ($entity instanceof Settings) {
            
            $file_favicon = $entity->getFavicon();

            if ($file_favicon instanceof UploadedFile) {
                $fileName = $this->uploader->upload($file_favicon,$date,'favicon');
                $entity->setFavicon($fileName);
            }
        }

        if ($entity instanceof Press) {
            
            $file_pdf = $entity->getPdf();

            if ($file_pdf instanceof UploadedFile) {
                $fileName = $this->uploader->upload($file_pdf,$date,'pdf');
                $entity->setPdf($fileName);
            }
        }


        if ($entity instanceof Image) {
            
            $file_src = $entity->getSrc();

            if ($file_src instanceof UploadedFile) {
                $fileName = $this->uploader->upload($file_src,$date,'image');
                $entity->setSrc($fileName);
            }
        }

        if ($entity instanceof BlocTeamMember) {
            
            $file_image = $entity->getImage();

            if ($file_image instanceof UploadedFile) {
                $fileName = $this->uploader->upload($file_image,$date,'favicon');
                $entity->setImage($fileName);
            }
        }
        
                
    }

}