<?php

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\ClientNameException;
/**
 * Value Object za ime servisa
 *
 * @author vedran
 */
class ClientName
{
    
    private $value;

    
    /**
     * 
     * @param string $value
     */
    public function __construct(string $value = '')
    {
        $this->setName($value);
    }
    
    /**
     * 
     * @param string $value
     * @throws ClientNameException
     */
    private function setName(string $value)
    {
        if(empty($value)){
            throw new ClientNameException("Ime servisa nije definisano.");
        }
        
        $this->value = $value;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
