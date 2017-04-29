<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

use Zend\Soap\Client;

/**
 * Factory za Zend Sopa 
 *
 * @author Vedran Vukoje <vedran.vukoje at telenor.rs>
 */
class ZendSoapFactory
{
    public function client($wsdl, array $options = []): Client
    {
        return new Client($wsdl, $options);
    }
}
