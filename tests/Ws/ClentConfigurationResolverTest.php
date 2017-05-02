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

    private $configuration;

    public function setUp()
    {
        $this->configuration = include __DIR__ . '/../Server/wsaws.php';
    }

    public function instanceWitOutOptionsIsEmptyArray()
    {
        
    }

}
