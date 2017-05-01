<?php

//echo \Tests\Ws\ClassMap\Server1RemoteTest5ClassMap::class;

return [
    'server1' => [
        'wsdl' => 'http://ws.tests/server1.php',
        'options' => [
            'classmap' => [
                'remoteTest1' => 'Tests\Ws\ClassMap\Server1RemoteTest1ClassMap',
                'remoteTest2' => 'Tests\Ws\ClassMap\Server1RemoteTest2ClassMap',
                'remoteTest5' => \Tests\Ws\ClassMap\Server1RemoteTest5ClassMap::class
            ]
            
        ]
    ],
    'server2' => [
        'wsdl' => 'http://ws.tests/server2.php',
        'options' => [
        ]
    ]
];
