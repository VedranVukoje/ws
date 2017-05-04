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
    private $config;
    private $soap;
    private $name;
    
    
    
    /**
     * 
     * @param \Wsa\Ws\SoapClientFactoryInterface $soap
     * @param \Wsa\Ws\ClientConfiguration $config
     */
    public function __construct(SoapClientFactoryInterface $soap, ClientConfiguration $config)
    {
        $this->soap = $soap;
        $this->name = $config->client();
        $this->setClient($config->wsdl(), $config->options());
        $this->config = $config;
    }
    
    public function name()
    {
        return $this->name;
    }
    
    public function __call($name, $arguments)
    {

        /**
         * @todo nesto mi nestima ovo !?!?
         * istrazi.
         * $client->nekaMetoda();
         * PHP Notice:  Undefined offset: 0 in /home/vedran/Projects/wsa/ws/src/Ws/Client.php
         * kako pozvati __call na metodu koja nema argumente?
         * @todo da ne petljas sa ovom proverom.
         * 
         * $a = 1;
         * $b = 1;
         * $client->nekaMetoda($a, $b); // [0 => 1, 1 => 1]
         * $client->nekaMetoda([ 'a' => $a, 'b' => $b ]); [ 0 => ["a" => 1, "b" => 1]]
         */
        $arguments = is_array($arguments[0])? $arguments[0] : $arguments;
        
        return call_user_func_array(
                [$this->client, 'call'], 
                [$name, $arguments]);
    }
    
    public function client()
    {
        return $this->client;
    }
    
    public function clientConfiguration(): ClientConfiguration
    {
        return $this->config;
    }

    private function setClient($wsdl, $options)
    {
        $this->client = $this->soap->client($wsdl, $options);
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