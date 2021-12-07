<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    
    private $aapKernel;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }
   
    public static function getSubscribedEvents(){
        return [
            BeforeEntityPersistedEvent::class => ['setIllustration'],  // avant de persister
            BeforeEntityUpdatedEvent::class => ['updateIllustration'] // avant de modifier
        ];
    }

    public function uploadIllustration($event){
        $entity = $event->getEntityInstance();
        $tmp_name = $_FILES['Product']['tmp_name']['illustration'];
        $fileName = uniqid();
        $extension = pathinfo($_FILES['Product']['tmp_name']['illustration'],PATHINFO_EXTENSION);
        $project_dir = $this->appKernel->getProjectDir();
        move_uploaded_file($tmp_name,$project_dir.'/public/uploads/'.$fileName.'.'.$extension);
        $entity->setIllustration($fileName.'.'.$extension);
        //dd($entity);
    }

   public function updateIllustration(BeforeEntityUpdatedEvent $event){
        
        if(!$event->getEntityInstance() instanceof Product){ // raha ts avy @ entité Product
            return; // retourne rien
        }

        if($_FILES['Product']['tmp_name']['illustration'] !=''){
            $this-> uploadIllustration($event);
        }
        //die('ok');
    }

    public function setIllustration(BeforeEntityPersistedEvent $event)
    {
        if(!$event->getEntityInstance() instanceof Product){ // raha ts avy @ entité Product
            return; // retourne rien
        }
        
        $this-> uploadIllustration($event);
    }
}

