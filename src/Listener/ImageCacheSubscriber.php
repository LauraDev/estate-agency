<?php

namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Property;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ImageCacheSubscriber implements EventSubscriber {
  
  /**
   * Cache Manager
   *
   * @var CacheManager
   */
  private $cacheManager;

  /**
   * UploaderHelper
   *
   * @var UploaderHelper
   */
  private $uploaderHelper;

  public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper) {
    $this->cacheManager = $cacheManager;
    $this->uploaderHelper = $uploaderHelper;
  }

  public function getSubscribedEvents()
  {
    return [
      'preRemove',
      'preUpdate'
    ];
  }

  public function preRemove(LifecycleEventArgs $args)
  {
    if (!$args->getEntity() instanceof Property) {
      return;
    }
    $this->cacheManager->remove(
      $this->uploaderHelper->asset($args->getEntity(), 'imageFile')
    );
  }

  public function preUpdate(PreUpdateEventArgs $args)
  {
    if (!$args->getEntity() instanceof Property) {
      return;
    }
    if ($args->getEntity()->getImageFile() instanceof UploadedFile) {
      $this->cacheManager->remove(
        $this->uploaderHelper->asset($args->getEntity(), 'imageFile')
      );
    }
  }
}