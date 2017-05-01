<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

/**
 * WS Client . 
 *
 * @author vedran
 */
class Client
{
    private $client;
    private $soap;
    private $wsdl;
    private $name;
    private $options;
    
    
    
    public function __construct(ZendSoapFactory $soap, ClientConfiguration $config)
    {
        $this->soap = $soap;
        $this->name = $config->client();
        $this->wsdl = $config->wsdl();
        $this->options = $config->options();
    }
    
    public function name()
    {
        return $this->name;
    }
    
    public function __call($name, $arguments)
    {
        if(null === $this->client){
            $this->client();
        }
        
        $arguments = is_array($arguments[0])? $arguments[0] : $arguments;
        
        return call_user_func_array(
                [$this->client, 'call'], 
                [$name, $arguments]);
    }


    private function client()
    {
        $this->client = $this->soap->client($this->wsdl, $this->options);
    }
    
    private function arguments($arguments)
    {
        return new \SoapParam($arguments, $this->name);
    }
}