<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\ClentConfigurationCollectionException;

/**
 * Iz PHP array mapiramo u array $_clientConfiguration \Closure 
 *
 * @author vedran
 */
class ClentConfigurationCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{

    /**
     *
     * @var ClientConfiguration [] kao Closure []
     */
    private static $_clientConfiguration = [];

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
        throw new ClentConfigurationCollectionException(sprintf($msg, $key));
    }

    public function getIterator()
    {
        return self::$_clientConfiguration;
    }

    public function offsetSet($offset, $value)
    {
        if (!$value instanceof ClientConfiguration) {
            throw new ClentConfigurationCollectionException(sprintf("Vrednost mora biti instanca od Wsa\Ws\ClientConfiguration."));
        }

        /**
         * @todo izbaci iz Closure 
         */
        self::$_clientConfiguration[$offset] = function() use ($value) {
            return $value;
        };
    }

    public function offsetGet($offset)
    {
        return $this->clientConfiguration($offset);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, self::$_clientConfiguration);
    }

    public function offsetUnset($offset)
    {
        unset(self::$_clientConfiguration[$offset]);
    }

    public function count()
    {
        return count(self::$_clientConfiguration);
    }

}
