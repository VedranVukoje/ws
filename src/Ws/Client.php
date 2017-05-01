<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Zend\Soap\Client as ZendSoapClient;
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
            $this->setClient();
        }
        
//        dump($arguments);
        $arguments = is_array($arguments[0])? $arguments[0] : $arguments;
        
        return call_user_func_array(
                [$this->client, 'call'], 
                [$name, $arguments]);
    }
    
    public function clinet(): ZendSoapClient
    {
        return $this->client;
    }

    private function setClient()
    {
        $this->client = $this->soap->client($this->wsdl, $this->options);
    }
    
    
    
    
    /**
     * @todo ovo ubaci u __call call_user_func_array kao $this->arguments($arguments)
     * http://stackoverflow.com/questions/12728358/how-do-i-create-a-php-soapparam-of-soapparams
     * @param array $arguments
     * @return \SoapParam
     */
    private function arguments($arguments)
    {
        return new \SoapParam($arguments, $this->name);
    }
}