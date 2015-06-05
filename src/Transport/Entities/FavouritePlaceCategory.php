<?php

namespace Base\Transport\Entities;

class FavouritePlaceCategory
{
    private $id = '';
    private $label = '';

    /** @return string */
    public function getId()
    {
        return $this->id;
    }

    /** @param string $id */
    public function setId($id)
    {
        $this->id = strtolower($id);
    }

    /** @return string */
    public function getLabel()
    {
        return $this->label;
    }

    /** @param string $label */
    public function setLabel($label)
    {
        $this->label = (string)$label;
    }
}
