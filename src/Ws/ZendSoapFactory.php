<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

/**
 * Factory za Zend Sopa Client
 *
 * @author Vedran Vukoje <vedran.vukoje at telenor.rs>
 */
class ZendSoapFactory implements SoapClientFactoryInterface
{

    public function client(string $wsdl = null, array $options = [])
    {
        return new \Zend\Soap\Client($wsdl, $options);
    }
}
