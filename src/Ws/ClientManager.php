<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\ClientNotFoundException;

/**
 * Description of ClientManager
 *
 * @author Vedran Vukoje <vedran.vukoje at telenor.rs>
 */
class ClientManager
{

    private $clientConfigurations;
    private static $clients = [];

    public function __construct(ClentConfigurationCollection $clientConfigurations)
    {
        $this->clientConfigurations = $clientConfigurations;
    }

    /**
     * 
     * @param string $name
     * @return Closure Client
     * @throws ClientNotFoundException
     */
    public function get(string $name): \Closure
    {

        if (isset(self::$clients[$name])) {
            return self::$clients[$name];
        }

        if ($conf = $this->clientConfigurations[$name]) {

            self::$clients[$name] = function() use ($conf) {
                return new Client(new ZendSoapFactory, $conf());
            };

            return self::$clients[$name];
        }

        throw new ClientNotFoundException(sprintf("Soap klijent '%s' nije pronadjen.", $name));
    }

    public function exists(string $name): bool
    {
        return isset(self::$clients[$name]);
    }

}
