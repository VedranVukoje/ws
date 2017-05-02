<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Wsa\Ws\Adapter\WsArrayCollection;
use Wsa\Ws\Exceptions\ClentConfigurationResolverException;

/**
 * Iz array mapiramo u array clientConfigurations ClientConfiguration[] 
 *
 * @author vedran
 */
class ClentConfigurationResolver implements \IteratorAggregate, \ArrayAccess
{

    /**
     *
     * @var ClientConfiguration [] kao Closure []
     */
    private $clientConfigurations;

    public function __construct(array $configuration = [])
    {
        $this->clientConfigurations = new WsArrayCollection();
        $this->setClientConfiguration($configuration);
    }

    public function clientConfigurations(): WsArrayCollection
    {
        return $this->clientConfigurations;
    }

    public function clientConfiguration($key): \Closure
    {
        return $this->clientConfigurations[$key];
    }

    public function getIterator()
    {
        return $this->clientConfigurations;
    }

    /**
     * Iz array mapiramo u array ClientConfiguration[]
     */
    public function resolve(array $configuration = [])
    {
        $this->setClientConfiguration($configuration);
    }

    public function offsetSet($offset, $value)
    {
        throw new ClentConfigurationResolverException('ClentConfigurationResolver je read-only.');
    }
    
    public function offsetGet($offset): \Closure
    {
        if($config = $this->clientConfigurations[$offset]){
            return $config;
        }
        
        $msg = 'Kljuc "%s" u array-u ClientConfiguration::clientConfigurations[] ne postoji.';
        throw new ClentConfigurationResolverException(sprintf($msg, $offset));
    }

    public function offsetExists($offset)
    {
        return isset($this->clientConfigurations[$offset]) && !empty($this->clientConfigurations[$offset]);
    }

    public function offsetUnset($offset)
    {
        throw new ClentConfigurationResolverException('ClentConfigurationResolver je read-only.');
    }

    /**
     * ClientConfiguration agregiramo u WsArrayCollection
     * @todo Ubaciti u OPcache
     * @todo Naci mozda neko prikladnije ime
     * @todo mozda ako zapne  sa Closure prebaci u ovo..
     * $this->clientConfiguration->set($clientName, new ClientConfiguration($clientName, $wsdl,$clientOption));
     * 
     * 
     */
    private function setClientConfiguration(array $configuration = [])
    {
        foreach ($configuration as $clientName => $clientSettings) {
            /**
             * 
             * Da li validirati i ovede?
             * $wsld se vec validira ClientConfiguration s $clientOptions 
             * isto u ClientConfiguration::setOptions ima defaultna podesavanja 
             */
            $wsld = $clientSettings['wsdl'] ?? '';
            $clientOptions = $clientSettings['options'] ?? [];

            $this->clientConfigurations->set($clientName, function() use ($clientName, $wsld, $clientOptions) {
                return new ClientConfiguration(new ClientName($clientName), new Wsdl($wsld), $clientOptions);
            });
        }
    }

}
