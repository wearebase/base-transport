<?php

namespace Base\Transport\Entities;

class AtcoCode
{
    protected $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function __toString()
    {
        return $this->code;
    }
}
