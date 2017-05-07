<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\WsException;
use Wsa\Ws\Exceptions\WsaWsException; 
use SoapFault;
use Exception;
use ErrorException;


/**
 * WS Clint manager .
 *
 * @author vedran
 */
final class Ws
{

    private $manager;
    
    /**
     * 
     * @param string $configPath
     * @return \static
     * @throws WsException
     */
    public static function build(string $configPath = '')
    {
        $config = $configPath . '/wsaws.php';
        if(!file_exists($config)){
            throw new WsException(sprintf('Konfiguracioni fajl "%s" ne postoji.', $config));
        }
        
        /**
         * @todo 
         * Ovo tek kasnije include 'config_za_wsawsclint.php'
         * u zavisnosti od alata ( framework ... ) lokacija za konfig...
         */
        $configuration = new ClientConfigurationCollection(include $configPath . '/wsaws.php');
        return new static(new ClientManager($configuration));
    }
    
    /**
     * 
     * @param string $name
     * @return \Wsa\Ws\Clint $ws 
     * @expectedException SoapFault|Exception|WsaWsException
     */
    public function get($name)
    {
        try {
            $ws = $this->manager->get($name);
            return $ws();
        } catch (WsaWsException $ex) {
            return $ex;
        } catch (SoapFault $ex) {
            return $ex;
        } catch (Exception $ex) {
            return $ex;
        } catch (ErrorException $ex){
            dump($ex);
        }
        
    }
    
    /**
     * 
     * @return \Wsa\Ws\ClientConfigurationCollection
     */
    public function configuration(): ClientConfigurationCollection
    {
        return $this->manager->clentConfigurationCollection();
    }

    /**
     * 
     * @param string $name
     * @return bool
     */
    public function exists($name): bool
    {
        return $this->manager->exists($name);
    }

    private function dump($dump)
    {
        \Symfony\Component\VarDumper\VarDumper::dump($dump);
    }

    private function __construct(ClientManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function debug()
    {
        set_error_handler([WsaWsException::class,'errorHandler']);
    }

}
