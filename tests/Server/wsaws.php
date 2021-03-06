<?php

return [
    'server1' => [
        'wsdl' => 'http://ws.tests/server1.php',
        'options' => [
            'classmap' => [
                'remoteTest1' => 'Tests\Ws\ClassMap\Server1RemoteTest1ClassMap',
                'remoteTest2' => 'Tests\Ws\ClassMap\Server1RemoteTest2ClassMap',
                'remoteTest5Out' => 'Tests\Ws\ClassMap\Server1RemoteTest5ClassMap'
            ]
        ]
    ],
    'server2' => [
        'wsdl' => 'http://ws.tests/server2.php',
        'options' => []
    ],
    'server3' => []
];
