<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wsa\Ws;

use Wsa\Ws\Exceptions\WsaWsException; 
use SoapFault;
use Exception;
/**
 * WsBuilder
 *
 * @author vedran
 */
final class Ws
{

    private $manager;

    public static function build($configPath)
    {
        /**
         * @todo 
         * Ovo tek kasnije include 'config_za_wsawsclint.php'
         * u zavisnosti od alata ( framework ... ) lokacija za konfig...
         */
        $configuration = new ClentConfigurationResolver(include $configPath . '/wsaws.php');
        return new static(new ClientManager($configuration, new ZendSoapFactory()));
    }

    public function get($name)
    {
        try {
            $ws = $this->manager->get($name);
            return $ws();
        } catch (WsaWsException $ex) {
            dump($ex);
        } catch (SoapFault $ex) {
            dump($ex);
        } catch (Exception $ex) {
            dump($ex);
        }
    }

    private function dump($dump)
    {
        \Symfony\Component\VarDumper\VarDumper::dump($dump);
    }

    private function __construct(ClientManager $manager)
    {
        $this->manager = $manager;
    }

}
