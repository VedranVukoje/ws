<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Iz array mapiramo u ClientConfiguration
 *
 * @author vedran
 */
class ClentConfigurationResolver implements \IteratorAggregate
{

    /**
     *
     * @var ClientConfiguration [] kao Closure []
     */
    private $clientConfigurations;
    
    public function __construct(array $options = [])
    {
        $this->clientConfigurations = new ArrayCollection();
        $this->setClientConfigurations($options);
    }
    
    public function clientConfigurations()
    {
        return $this->clientConfigurations;
    }


    public function clientConfiguration($key)
    {
        return $this->clientConfigurations[$key];
    }
    
    public function getIterator()
    {
        return $this->clientConfigurations;
    }

    /**
     * Iz array mapiramo u ClientConfiguration
     * 
     * @todo Ubaciti u OPcache
     * @todo mozda ako zapne  sa Closure prebaci u ovo..
     * $this->clientConfiguration->set($clientName, new ClientConfiguration($clientName, $wsdl,$clientOption));
     * 
     * @param array $options
     */
    public function resolve(array $options = [])
    {
        $this->setClientConfigurations($options);
    }
    
    /**
     * ClientConfiguration agregiramo u ArrayCollection
     * @todo Naci mozda neko prikladnije ime
     * @param array $options
     */
    private function setClientConfigurations(array $options = [])
    {
        foreach ($options as $clientName => $clientSettings) {
            /**
             * @todo validacija ovde ???? za wsdl i options...
             */
            $wsld = $clientSettings['wsdl'];
            $clientOptions = $clientSettings['options'];
            
            $this->clientConfigurations->set($clientName, function() use ($clientName, $wsld, $clientOptions){
                return new ClientConfiguration($clientName, $wsld, $clientOptions);
            });
        }
    }
}
