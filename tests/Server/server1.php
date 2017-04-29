<?php

/*
 * Wsa Webservice server
 */

namespace {
//    error_reporting(error_reporting() & ~E_USER_DEPRECATED);
    $loader = require __DIR__ . '/vendor/autoload.php';
}

namespace Wsa\Ws {
    
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Zend\Soap\AutoDiscover;

    $request = Request::createFromGlobals();
    
//    echo $request->getMethod();
    if ('GET' == $request->getMethod()) {
        
        $autoDiscover = new AutoDiscover();
        $autoDiscover->setUri('http://learn.symfony/wsaws.php');
        $autoDiscover->setServiceName('WsaWs');
        $autoDiscover->setClass(Tsi::class);
        $wsdl = $autoDiscover->generate();
        
        $response = (new Response())->setContent($wsdl->toXML());
        
        $response->headers->set('Content-Type','text/xml; charset=utf-8');
        
        $response->send();
    }
    
    if('POST' == $request->getMethod()){
        $server = new \Zend\Soap\Server("http://learn.symfony/wsaws.php",[
            'actor' => "http://learn.symfony/wsaws.php"
        ]);
        $server->setClass(Tsi::class);
        $server->handle();
    }

}

namespace {
    return $loader;
}