<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\ClientNameException;
/**
 * Description of ClientName
 *
 * @author vedran
 */
class ClientName
{
    
    private $value;


    public function __construct(string $value = '')
    {
        $this->setName($value);
    }
    
    private function setName(string $value)
    {
        if(empty($value)){
            throw new ClientNameException("Ime servisa nije definisano.");
        }
        
        $this->value = $value;
    }
    
    public function __toString()
    {
        return $this->value;
    }
}
