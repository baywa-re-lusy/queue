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
                ],
            'factories' =>
                [
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
