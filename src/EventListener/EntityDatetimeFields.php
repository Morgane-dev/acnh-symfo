<?php

declare(strict_types=1);

namespace App\EventListener;

use DateTime;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityDatetimeFields
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        $entity->setCreatedAt(new DateTime());
        $entity->setUpdatedAt(new DateTime());
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        $entity->setUpdatedAt(new DateTime());
    }
}