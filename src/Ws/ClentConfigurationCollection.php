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
 * Iz PHP array mapiramo u array clientConfigurations ClientConfiguration[] 
 *
 * @author vedran
 */
class ClentConfigurationCollection implements \IteratorAggregate, \ArrayAccess
{

    /**
     *
     * @var ClientConfiguration [] kao Closure []
     */
    
    private static $_clientConfiguration;

    public function __construct(array $configuration = [])
    {
        
        $this->configuration = $configuration;
    }

    public function clientConfiguration($key)
    {
        if (self::$_clientConfiguration[$key]) {
            return self::$_clientConfiguration[$key];
        }
        
        if ($conf = $this->configuration[$key]) {
            
            
            /**
             * @todo 
             * ?????????
             * 
             */
            $wsld = $conf['wsdl'] ?? '';
            $clientOptions = $conf['options'] ?? [];
            
            /**
             * @todo izbaci iz Closure 
             */
            self::$_clientConfiguration[$key] = function() use ($key, $wsld, $clientOptions) {
                return new ClientConfiguration(new ClientName($key), new Wsdl($wsld), $clientOptions);
            };
            
            return self::$_clientConfiguration[$key];
        }


        $msg = 'Kljuc "%s" u array-u ClientConfiguration::clientConfigurations[] ne postoji.';
        throw new ClentConfigurationResolverException(sprintf($msg, $key));
    }

    public function getIterator()
    {
        return self::$_clientConfiguration;
    }

    public function offsetSet($offset, $value)
    {
        /**
         * @todo ne moze ovoako... $value ????
         */
        return $this->clientConfiguration($offset);
    }

    public function offsetGet($offset)
    {
        return $this->clientConfiguration($offset);
    }

    public function offsetExists($offset)
    {
        return isset($this->clientConfigurations[$offset]) && !empty($this->clientConfigurations[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset(self::$_clientConfiguration[$offset]);
    }

    

}
