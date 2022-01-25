BayWa r.e. Queue Tools
======================

[![CircleCI](https://circleci.com/gh/baywa-re-lusy/queue/tree/master.svg?style=svg)](https://circleci.com/gh/baywa-re-lusy/queue/tree/master)

## Installation

To install the Queue tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/queue
```

## Usage

Currently, this library only supports AWS SQS. However, it uses an Adapter pattern to allow adding other vendors easily.

```php
use BayWaReLusy\QueueTools\QueueToolsConfig;
use BayWaReLusy\QueueTools\QueueTools;
use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapter;

$queueToolsConfig = new QueueToolsConfig($awsRegion, $awsKey, $awsSecret);
$queueTools       = new QueueTools($queueToolsConfig);
$queueService     = $queueTools->get(QueueService::class);
$queueService->setAdapter($emailTools->get(AwsSqsAdapter::class));
```

Optionally, you can include then the Queue Client into your Service Manager:

```php
$sm->setService(QueueTools::class, $queueTools);
```
