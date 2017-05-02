<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

/**
 *
 * @author vedran
 */
interface SoapClientFactoryInterface
{
    /**
     * Impementacija za SopaClient npr PHP SopaClient, nusoap ili Zao sada Zend\Soap\Client . 
     * @param string $wsdl
     * @param array $options
     */
    public function client(string $wsdl, array $options);
}
