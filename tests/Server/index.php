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
    
//    $conf1 = \Tests\Ws\TestAssets\ClientConfigurationObject::creteOne();
    
    
    $ws = Ws::build(__DIR__);
    $ws->debug();
    
    echo '$ws->get(\'Nepostoji\')';
    $s = $ws->get('Nepostoji');
    dump($s);
    echo '$ws->get(\'server1\')';
    $server1 = $ws->get('server1');
    dump($server1);
    echo '$server1->remoteTest2([\'a\' => 1, \'b\' => 3])';
    dump($server1->remoteTest2(['a' => 1, 'b' => 3]));
    echo '$server1->client()->getLastRequest();';
    dump($server1->client()->getLastRequest());
    echo '$server1->client()->getLastResponse();';
    dump($server1->client()->getLastResponse());
    echo '$server1->clientConfiguration()';
    dump($server1->clientConfiguration());
    echo '$ws->get(\'server1\')->remoteTest2(1,3)';
    dump($ws->get('server1')->remoteTest2(1,3));
    echo '$ws->get(\'server1\')->remoteTest4()';
    dump($ws->get('server1')->remoteTest4());
    echo '$ws->get(\'server1\')->remoteTest5()';
    dump($ws->get('server1')->remoteTest5());
    $config = $ws->configuration();
    echo '$config = $ws->configuration(); $config[\'server1\'];';
    dump($config['server1']);
    echo '$configuration = $ws->get(\'server1\')->configuration()';
    $configuration = $ws->configuration();
    dump($configuration);
    $configuration['ServerCreateOne'] = \Tests\Ws\TestAssets\ClientConfigurationObject::creteOne();
    echo '$configuration[\'ServerCreateOne\'] = Wsa\Ws\ClientConfiguration;';
    dump($ws->get('ServerCreateOne'));
    
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

