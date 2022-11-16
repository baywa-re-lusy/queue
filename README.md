BayWa r.e. Queue Tools
======================

[![CircleCI](https://circleci.com/gh/baywa-re-lusy/queue/tree/master.svg?style=svg)](https://circleci.com/gh/baywa-re-lusy/queue/tree/master)

## Installation

To install the Queue tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/queue
```

## Usage

Currently, this library supports AWS SQS and Azure Queue. However, it uses an Adapter pattern to allow adding other vendors easily.

```php
use BayWaReLusy\QueueTools\QueueToolsConfig;
use BayWaReLusy\QueueTools\QueueTools;
use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapter;

$queueToolsConfig = new QueueToolsConfig($awsRegion, $awsKey, $awsSecret);
$queueTools       = new QueueTools($queueToolsConfig);
$queueService     = $queueTools->get(QueueService::class);
$queueService->setAdapter($queueTools->get(AwsSqsAdapter::class));
```

```php
$queueToolsConfig = new QueueToolsConfig(
        "<Unused for this adapter, fill with anything>",
        "<The azure SAS Token>",
        "<Unused for this adapter, fill with anything>",
        "<The Queue's name'>",
        "<The queue EndPoint (xxxxx.queue.core.windows.net)">
);
$queueTools       = new QueueTools($queueToolsConfig);
$queueService     = $queueTools->get(QueueService::class);
$queueService->setAdapter($queueTools->get(AzureQueueAdapter::class));
```


Optionally, you can include then the Queue Client into your Service Manager:

```php
$sm->setService(QueueTools::class, $queueTools);
```

