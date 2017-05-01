<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Ws;

/**
 * Description of ClentConfigurationResolverTest
 *
 * @author vedran
 */
class ClentConfigurationResolverTest extends \PHPUnit_Framework_TestCase
{
    
    public function nesto()
    {
        
    }

    

    public function config()
    {
        return [
            'server1' => [
                'wsdl' => 'http://ws.tests/server1.php',
                'options' => [
                    
                ]
            ],
            'server2' => [
                'wsdl' => 'http://ws.tests/server2.php',
                'options' => [
                    
                ]
            ]
        ];
    }
}
