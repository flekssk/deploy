<?php

namespace App\Application\Utils;

class CircularReferenceHandler
{
    /**
     * @param $object
     * @return mixed
     */
    public function __invoke($object)
    {
        return $object->getId();
    }
}