<?php

use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapter;
use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapterFactory;

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                    QueueService::class
                ],
            'factories' =>
                [
                    AwsSqsAdapter::class => AwsSqsAdapterFactory::class,
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
