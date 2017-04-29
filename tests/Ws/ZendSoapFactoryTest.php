<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Tests\Ws;

use Wsa\Ws\ZendSoapFactory;
/**
 * Description of ZendSoapFactoryTest
 *
 * @author vedran
 */
class ZendSoapFactoryTest extends \PHPUnit_Framework_TestCase
{
    
    private $wsdl;
    
    private $options;
    
    public function setUp()
    {
        
    }


    /**
     * 
     * @test
     * @expectedException \Wsa\Ws\Exceptions\SoapWsdlCanNotBeEmpty
     */
    public function shouldThrowException()
    {
        (new ZendSoapFactory)->client();
    }
    
    public function shouldBeInstanceOfWsClient()
    {
        //$this->getMockFromWsdl($wsdlFile)
    }
}
