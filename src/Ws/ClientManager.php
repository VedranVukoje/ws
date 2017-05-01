<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

use Wsa\Ws\Adapter\WsArrayCollection;
use Wsa\Ws\Exceptions\ClientNotFoundException;

/**
 * Description of ClientManager
 *
 * @author Vedran Vukoje <vedran.vukoje at telenor.rs>
 */
class ClientManager
{
    private $clientConfigurations;
    private $ws;
    private $sopa;
    
    private static $clients = [];

    public function __construct(
            ClentConfigurationResolver $clientConfigurations,
            ZendSoapFactory $soap)
    {
        $this->ws = new WsArrayCollection();
        $this->clientConfigurations = $clientConfigurations;
        $this->sopa = $soap;
    }
    
    /**
     * 
     * @param string $name
     * @return Closure Client
     * @throws ClientNotFoundException
     */
    public function get($name): \Closure
    {
        
        if(isset(self::$clients[$name])){
            return self::$clients[$name];
        }
        
        if($conf = $this->clientConfigurations[$name]){
            $soap = $this->sopa;
            self::$clients[$name] = function() use ($soap,$conf){
                return new Client($soap,$conf());
            };
            
            return self::$clients[$name];
        }
        
        throw new ClientNotFoundException(sprintf("Klijent '%s' nije pronadjen.", $name));
    }

}
