<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Ws;

use Wsa\Ws\ClientName;
/**
 * Description of ClientNameException
 *
 * @author vedran
 */
class ClientNameTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * 
     * @test
     * @expectedException \Wsa\Ws\Exceptions\ClientNameException
     */
    public function shouldThrowClientNameException()
    {
        new ClientName;
    }
    
    /**
     * 
     * @test
     * 
     */
    public function shouldBeCastString()
    {
        
        $one = new ClientName('one');
        $one_ = new ClientName('one');
        $two = new ClientName('two');
        
        $this->assertInstanceOf(ClientName::class, $one);
        $this->assertEquals((string)$one, (string)$one_);
        $this->assertNotEquals((string)$two, (string)$one_);
    }
}
