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

        public function __construct()
        {
            $this->vedaran = 'vukoje';
        }

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
            return $a + $b;
        }

        /**
         * 
         * @param array $array
         * @return string
         */
        public function rmoeteTest3(array $array = ['key' => 1, 'value' => 'one'])
        {
            return $array['key'] . ' => ' . $array['one'];
        }

        /**
         * 
         * @return array
         */
        public function remoteTest4()
        {
            return ['key' => 1, 'value' => 'one'];
        }

        /**
         * 
         * @return \stdClass
         */
        public function remoteTest5()
        {
            $object = new \stdClass();

            $object->one = 1;
            $object->two = ['nesto...'];

            return $object;
        }

    }

//    echo $request->getMethod();
    if ('GET' == $request->getMethod()) {

        $autoDiscover = new AutoDiscover();
        $autoDiscover->setUri('http://ws.tests/server1.php');
        $autoDiscover->setServiceName('Server1');
        $autoDiscover->setClass(Server1::class);
//        $autoDiscover->setOperationBodyStyle(array('use' => 'literal', 'namespace' => 'http://ws.tests/server1.php'));
//        $autoDiscover->setBindingStyle(['style' => 'document','transport' => 'http://schemas.xmlsoap.org/soap/http']);

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