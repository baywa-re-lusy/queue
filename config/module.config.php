<?php

use BayWaReLusy\QueueTools\Adapter\AzureQueueAdapter;
use BayWaReLusy\QueueTools\Adapter\AzureQueueAdapterFactory;
use BayWaReLusy\QueueTools\Adapter\AzuriteAdapter;
use BayWaReLusy\QueueTools\Adapter\AzuriteAdapterFactory;
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
                    AzureQueueAdapter::class => AzureQueueAdapterFactory::class,
                    AzuriteAdapter::class => AzuriteAdapterFactory::class
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
