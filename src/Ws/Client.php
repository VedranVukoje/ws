<?php

/**
 * WSA\WS Lib
 */
namespace Wsa\Ws;

use Zend\Soap\Client as ZendSoapClient;

/**
 * WSA\WS Client . 
 *
 * @author vedran
 */
class Client
{
    /**
     *
     * @var \Zend\Soap\Client 
     */
    private $client;
    /**
     *
     * @var \Wsa\Ws\ClientConfiguration 
     */
    private $config;
    /**
     *
     * Factory za zend \Zend\Soap\Client
     * @var \Wsa\Ws\SoapClientFactoryInterface 
     */
    private $soap;
    /**
     *
     * @var \Waa\Ws\ClientName 
     */
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
    
    /**
     * 
     * @return \Wsa\Ws\ClientName
     */
    public function name(): ClientName
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
//        $arguments = empty($arguments)? $arguments : is_array($arguments[0])? $arguments[0]:$arguments;
        return call_user_func_array(
                [$this->client, 'call'], 
                [$name, $arguments]);
    }
    
    /**
     * 
     * @return \Zend\Soap\Client
     */
    public function client(): ZendSoapClient
    {
        return $this->client;
    }
    
    /**
     * 
     * @return \Wsa\Ws\ClientConfiguration
     */
    public function clientConfiguration(): ClientConfiguration
    {
        return $this->config;
    }

    private function setClient($wsdl, $options)
    {
        /**
         * @todo 
         * ?????????? msm da ovo treba drugacije.
         * 
         */
        if(null === $this->client){
            $this->client = $this->soap->client($wsdl, $options);
        }
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