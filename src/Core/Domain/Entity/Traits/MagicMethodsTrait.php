<?php


namespace Core\Domain\Entity\Traits;

trait MagicMethodsTrait
{
    /**
     * @throws \Exception
     */
    public function __get($property)
    {
        if (isset($this->$property)) return $this->$property;

        $class = get_class($this);
        throw new \Exception("Property {$property} does not exist in {$class}");
    }

    /**
     * @param $property
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        if (isset($this->$property)) {
            return $this->$property = $value;
        }

        $class = get_class($this);
        throw new \Exception("Property {$property} does not exist in {$class}");
    }

    public function getId(): string
    {
        return (string)$this->id;
    }

    public function getCreatedAt(): String {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    public function getUpdatedAt(): String {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}