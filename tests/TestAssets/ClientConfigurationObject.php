<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Ws\TestAssets;

use Wsa\Ws\ClientConfiguration;
use Wsa\Ws\ClientName;
use Wsa\Ws\Wsdl;

/**
 * Description of ClientConfigurationObject
 *
 * @author vedran
 */
class ClientConfigurationObject
{

    public static function creteOne()
    {
        return new ClientConfiguration(
                new ClientName('ServerCreateOne'), new Wsdl('http://ws.tests/server1.php'), []
        );
    }

}
