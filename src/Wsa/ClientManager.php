<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

use Doctrine\Common\Collections\ArrayCollection;
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


    public function __construct(
            ClentConfigurationResolver $clientConfigurations,
            ZendSoapFactory $soap)
    {
        $this->ws = new ArrayCollection();
        $this->clientConfigurations = $clientConfigurations;
        $this->sopa = $soap;
        $this->load();
    }
    
    /**
     * 
     * @param string $name
     * @return Closure Client
     * @throws ClientNotFoundException
     */
    public function get($name): \Closure
    {
        if($ws = $this->ws[$name]){
            return $ws;
        }
        
        throw new ClientNotFoundException(sprintf("Klijent '%s' nije pronadjen."));
    }


    private function load()
    {
        $soap = $this->sopa;
        foreach ($this->clientConfigurations as $conf)
        {
            $this->ws->set($conf()->client(), function() use ($soap,$conf){
                return new Client($soap,$conf());
            });
        }
    }
}
