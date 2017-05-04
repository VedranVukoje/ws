<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Ws;
use Wsa\Ws\Wsdl;

/**
 * Description of WsdlTest
 *
 * @author vedran
 */
class WsdlTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @test
     * @expectedException \Wsa\Ws\Exceptions\WsdlException
     */
    public function shouldBeThrowException()
    {
        new Wsdl;
        new Wsdl('');
    }

    /**
     * 
     * @test
     */
    public function shouldBeCastString()
    {
        $one = new Wsdl('http://ws.tests/server1.php');
        $one_ = new Wsdl('http://ws.tests/server1.php');
        
        $this->assertInstanceOf(Wsdl::class, $one);
        $this->assertEquals((string)$one, (string)$one_);
    }
}
