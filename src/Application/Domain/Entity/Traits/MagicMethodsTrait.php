<?php


namespace Application\Domain\Entity\Traits;

trait MagicMethodsTrait {
    public function __get($property) {
        if(isset($this->$property)) return $this->$property;

        $class = get_class($this);
        throw new \Exception("Property {$property} does not exist in {$class}");
    }

    public function __set($property, $value) {
        if(isset($this->$property)) return $this->$property = $value;

        $class = get_class($this);
        throw new \Exception("Property {$property} does not exist in {$class}");
    }
}