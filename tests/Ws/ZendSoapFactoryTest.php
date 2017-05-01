<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Tests\Ws;

use Wsa\Ws\ZendSoapFactory;
use Zend\Soap\Client;
/**
 * Description of ZendSoapFactoryTest
 *
 * @author vedran
 */
class ZendSoapFactoryTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * 
     * @test
     * @expectedException \Wsa\Ws\Exceptions\SoapWsdlCanNotBeEmpty
     */
    public function shouldThrowException()
    {
        (new ZendSoapFactory)->client();
    }
    
    /**
     * 
     * @test
     */
    public function shouldBeInstanceOfZendSoapClient()
    {
        $clent = (new ZendSoapFactory)->client('http://ws.tests/server1.php');
        
        $this->assertInstanceOf(Client::class, $clent);
    }
}
