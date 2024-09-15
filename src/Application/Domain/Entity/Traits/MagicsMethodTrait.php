<?php


namespace Application\Domain\Entity\Traits;

trait MagicsMethodTrait {
    public function __get($property) {
        if($this->$property) return $this->$property;

        $class = get_class($this);
        throw new \Exception("Property {$property} does not exist in {$class}");
    }
}