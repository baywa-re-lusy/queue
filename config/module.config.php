<?php

use BayWaReLusy\QueueTools\Adapter\AzureQueueAdapter;
use BayWaReLusy\QueueTools\Adapter\AzureQueueAdapterFactory;
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
                    AzureQueueAdapter::class => AzureQueueAdapterFactory::class
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
