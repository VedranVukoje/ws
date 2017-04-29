<?php

/*
 *  WSA
 *  vedran.vukoje@telenotr.rs
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\SoapWsdlCanNotBeEmpty;
use Zend\Soap\Client;

/**
 * Factory za Zend Sopa 
 *
 * @author Vedran Vukoje <vedran.vukoje at telenor.rs>
 */
class ZendSoapFactory
{

    public function client(string $wsdl = null, array $options = []): Client
    {
        if (empty($wsdl)) {
            throw new SoapWsdlCanNotBeEmpty("Nema vrednosti za 'wsdl' kljuc u wsaws.php");
        }

        return new Client($wsdl, $options);
    }
}
