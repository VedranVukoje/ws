<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

/**
 * Description of Wsdl
 *
 * @author vedran
 */
class Wsdl
{

    private $value;

    public function __construct(string $value = '')
    {
        $this->setValue($value);
    }

    private function setValue(string $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

}
