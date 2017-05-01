<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ClientConfiguration
 * 
 * Konfiguracija za klijent (\Wsa\Ws\Client) . 
 * Objekat se instancira u ClentConfigurationResolver::setClientConfigurations
 * 
 *
 * @author vedran
 */
class ClientConfiguration
{

    /**
     * Ime Klijenta
     * @var string
     */
    private $clientName;

    /**
     * Wsdl za \Zend\Soap\Client
     * @var string 
     */
    private $wsdl;

    /**
     * Options za \Zend\Soap\Client
     * @var type array
     */
    private $options;
    
    /**
     * 
     * @param \Wsa\Ws\ClientName $clientName
     * @param \Wsa\Ws\Wsdl $wsdl
     * @param array $options
     */
    public function __construct(ClientName $clientName, Wsdl $wsdl, array $options = [])
    {
        $this->clientName = $clientName;
        $this->wsdl = $wsdl;
        $this->setOptions($options);
    }

    /**
     * 
     * @return \Wsa\Ws\Wsdl
     */
    public function wsdl()
    {
        return $this->wsdl;
    }

    /**
     * 
     * @return \Wsa\Ws\ClientName
     */
    public function client()
    {
        return $this->clientName;
    }

    /**
     * 
     * @return []
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * Default podesavanja za Zend\Soap\Client
     * @param array $options
     */
    private function setOptions(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'classmap' => null,
            'encoding' => 'UTF-8',
            'soapversion' => SOAP_1_2,
            'uri' => null,
            'location' => null,
            'style' => null,
            'use' => null,
            'login' => null,
            'password' => null,
            'proxyhost' => null,
            'proxyport' => null,
            'proxylogin' => null,
            'proxylogin' => null,
            'proxypassword' => null,
            'localcert' => null,
            'passphrase' => null,
            'compression' => null,
            'streamcontext' => null,
            'cachewsdl' => null,
            'useragent' => null,
            'typemap' => null,
            'connectiontimeout' => null,
            'keepalive' => null,
            'sslmethod' => null
        ]);



        /**
         * @todo
         * Mozda procackati bolje resenje ?
         * ocije koje imaju vrednost null ne koristimo
         */
        $this->options = array_filter($resolver->resolve($options), function($option) {
            return null !== $option;
        });
    }

}
