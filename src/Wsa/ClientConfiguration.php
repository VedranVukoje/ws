<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\ClientConfigurationException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ClientConfiguration
 * 
 * Konfiguracija za \Zend\Soap\Client klijent. Konfiguracija je namapirana iz
 * config.php fajla u ClentConfigurationResolver::resolve
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


    public function __construct($clientName, $wsdl ,array $options = [])
    {
        $this->setClientName($clientName);
        $this->setWsdl($wsdl);
        $this->setOptions($options);
    }
    
    /**
     * 
     * @return string
     */
    public function wsdl()
    {
        return $this->wsdl;
    }
    
    /**
     * 
     * @return string
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
     * @todo prebaciti u VO ClientName
     * @param string $clientName
     * @throws ClientConfigurationException
     */
    private function setClientName($clientName)
    {
        
        if(empty($clientName)){
            throw new ClientConfigurationException("Ime servisa nije definisano.");
        }
        
        $this->clientName = $clientName;
    }
    
    /**
     * @todo prebaciti u VO Wsdl !
     * @param string $wsdl
     */
    private function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
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
        $this->options = array_filter($resolver->resolve($options), function($option){
            return null !== $option;
        });
    }
}
