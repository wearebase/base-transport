<?php

namespace Base\Transport\Entities;

class FavouritePlaceIcon
{
    private $category = '';
    private $label = '';

    /** @return string */
    public function getCategory()
    {
        return $this->category;
    }

    /** @param string $category */
    public function setCategory($category)
    {
        $this->category = strtolower($category);
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
