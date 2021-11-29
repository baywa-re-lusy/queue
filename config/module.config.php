<?php

use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\SqsAdapter;
use BayWaReLusy\QueueTools\Adapter\SqsAdapterFactory;

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                    QueueService::class
                ],
            'factories' =>
                [
                    SqsAdapter::class => SqsAdapterFactory::class,
                ],
            'abstract_factories' =>
                [
                ],
            'initializers' =>
                [
                ],
            'shared' =>
                [
                ]
        ]
];
