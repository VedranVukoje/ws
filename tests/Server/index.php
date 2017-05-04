<?php

/*
 * Wsa Webservice server
 */

namespace {
    error_reporting(error_reporting() & ~E_USER_DEPRECATED);
    $loader = require __DIR__ . '/../../vendor/autoload.php';
}

namespace Wsa\Ws {
//$soapclient_options['soap_version'] = 'SOAP_1_2';
function dump($dump){
    \Symfony\Component\VarDumper\VarDumper::dump($dump);
}
   use Wsa\Ws\Exceptions\WsaWsException;
   use Throwable;
    


try{
    (new ZendSoapFactory)->client();
//    new \Zend\Soap\Client;
    
    
    /**
     * @todo 
     * Ovo tek kasnije include 'config_za_wsawsclint.php'
     * u zavisnosti od alata ( framework ... ) lokacija za konfig...
     */
//    $configuration = new ClentConfigurationResolver(include 'wsaws.php');
    
    $ws = Ws::build(__DIR__);
    
    $server1 = $ws->get('server1');
    
    dump($server1->remoteTest2(['a' => 1, 'b' => 3]));
    dump($server1->client()->getLastResponse());
    dump($ws->get('server1')->remoteTest2(1,3));
    
    dump($ws->get('server1')->remoteTest4());
    dump($ws->get('server1')->remoteTest5());
    
    
//    dump($ws->get('server3'));
    
//    dump($object->one);
    
//    ;
    
    
    
    
} catch (WsaWsException $ex) {
    dump($ex);
} catch (\Exception $ex) {
    dump($ex);
} catch (Throwable $t){
    dump($t);
}



//    try {
//        $client = new \Zend\Soap\Client(
//                'http://learn.symfony/wsaws.php', [
//                    'classmap' => [
//                        'getMessageOut' => GetMessage::class
//                    ]]
//        );
//
//
//
//
//
//        \Symfony\Component\VarDumper\VarDumper::dump($client->getMessage());
//    } catch (\SoapFault $ex) {
//        \Symfony\Component\VarDumper\VarDumper::dump($ex);
//    }
}

namespace {
    return $loader;
}

