<?php

/*
 * Wsa Webservice server
 */

namespace {
//    error_reporting(error_reporting() & ~E_USER_DEPRECATED);
    $loader = require __DIR__ . '/../../vendor/autoload.php';
}

namespace Wsa\Ws {

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Zend\Soap\AutoDiscover;

    $request = Request::createFromGlobals();

    class Server1
    {
        
        /**
         * 
         * @return string
         */
        public function remoteTest1()
        {
            return 'remoteTest';
        }
        
        /**
         * 
         * @param int $a
         * @param int $b
         * @return int
         */
        public function remoteTest2($a, $b)
        {
            return $a+$b;
        }
    }

//    echo $request->getMethod();
    if ('GET' == $request->getMethod()) {

        $autoDiscover = new AutoDiscover();
        $autoDiscover->setUri('http://ws.tests/server1.php');
        $autoDiscover->setServiceName('Server1');
        $autoDiscover->setClass(Server1::class);
        $wsdl = $autoDiscover->generate();

        $response = (new Response())->setContent($wsdl->toXML());

        $response->headers->set('Content-Type', 'text/xml; charset=utf-8');

        $response->send();
    }

    if ('POST' == $request->getMethod()) {
        $server = new \Zend\Soap\Server("http://ws.tests/server1.php", [
            'actor' => "http://ws.tests/server1.php"
        ]);
        $server->setClass(Server1::class);
        $server->handle();
    }
}

namespace {
    return $loader;
}