<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Ws;

use Wsa\Ws\ClentConfigurationCollection;
use Wsa\Ws\ClientConfiguration;
use Closure;
/**
 * PHP Warning  Notice setujemo na disabled
 * u slucaju da ne postoji konfiguracija ocekujemo 
 * \Wsa\Ws\Exceptions\ClentConfigurationCollectionException
 */
\PHPUnit_Framework_Error_Warning::$enabled = FALSE;
\PHPUnit_Framework_Error_Notice::$enabled = FALSE;
/**
 * Description of ClentConfigurationResolverTest
 * 
 * @author vedran
 */
class ClentConfigurationCollectionTest extends \PHPUnit_Framework_TestCase
{

    private $configuration;

    public function setUp()
    {
        $this->configuration = new ClentConfigurationCollection(include __DIR__ . '/../Server/wsaws.php');
        
    }
    
    /**
     * @test
     */
    public function instanceWitOutOptionsIsEmptyArray()
    {
        $configuration = new ClentConfigurationCollection;
        $this->assertCount(0, $configuration);
        $this->assertEmpty($configuration);
    }
    
    /**
     * @test 
     * @expectedException \Wsa\Ws\Exceptions\ClentConfigurationCollectionException
     */
    public function shouldThrowExceptionIfConfigurationDoseNotExist()
    {
        $this->configuration['konfiguracija_koja_ne_postoji'];
    }
    /**
     * @test 
     * @expectedException \Wsa\Ws\Exceptions\ClentConfigurationCollectionException
     */
    public function whenSettingNewKeyShouldThrowException()
    {
        $this->configuration['ServerTest1'] = '';
    }
    
    /**
     * 
     * @test
     */
    public function shouldBeInstanceOfClosure()
    {
        $this->configuration['crateOne'] = \Tests\Ws\TestAssets\ClientConfigurationObject::creteOne();
        
        $this->assertInstanceOf(Closure::class, $this->configuration['crateOne']);
    }

}
