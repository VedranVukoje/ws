<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Ws;

use Wsa\Ws\Ws;
use Wsa\Ws\Client;
use Wsa\Ws\ClientConfigurationCollection;
use Wsa\Ws\ClientManager;
use Wsa\Ws\Exceptions\WsaWsException;
use Wsa\Ws\Exceptions\WsException;
/**
 * Description of WsTest
 *
 * @author vedran
 */
class WsTest extends \PHPUnit_Framework_TestCase
{
    
    private $ws;
    
    public function setUp()
    {
        $this->ws = Ws::build(__DIR__.'/../Server');
    }

    /**
     * 
     * @test
     * @expectedException Wsa\Ws\Exceptions\WsException
     */
    public function shouldThrowWsException()
    {
        Ws::build();
    }
    
    
    /**
     * 
     * @test
     */
    public function shouldBeInstanceOfWs()
    {
        $this->assertInstanceOf(Ws::class, $this->ws);
    }
    
    /**
     * 
     * @test
     */
    public function shouldBeInstanceOfClient()
    {
        $client = $this->ws->get('server1');
        
        $this->assertTrue($client instanceof Client);
    }
    
    /**
     * @test
     * @expectedException Wsa\Ws\Exceptions\ClentConfigurationCollectionException
     */
    public function shouldThrowClentConfigurationCollectionException()
    {
        $this->ws->get('Nepostoji');
    }


    /**
     * 
     * @test
     */
    public function shouldBeInstanceOfClientConfigurationCollection()
    {
        $configuration = $this->ws->configuration();
        $this->assertTrue($configuration instanceof ClientConfigurationCollection);
    }
    
    
}
