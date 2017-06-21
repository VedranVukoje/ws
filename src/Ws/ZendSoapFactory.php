<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

use Zend\Soap\Client;

/**
 * Factory za Zend Sopa Client
 *
 * @author Vedran Vukoje <vedran.vukoje at telenor.rs>
 */
class ZendSoapFactory implements SoapClientFactoryInterface
{

    public function client(string $wsdl = null, array $options = [])
    {
        return new Client($wsdl, $options);
    }
}
