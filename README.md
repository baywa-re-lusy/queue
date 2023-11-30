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

#### AWS
```php
use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapter;

$adapter = new AwsSqsAdapter($awsRegion, $awsKey, $awsSecret, $sqsEndpoint);
$queueService = new QueueService($adapter);
```
The SQS endpoint is optional and is only necessary for non-AWS SQS-providers (like ElasticMQ).

#### Azure
```php
use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AzureQueueAdapter;

$adapter = new AzureQueueAdapter($queueEndpoint, $sasToken);
$queueService = new QueueService($adapter);
```

If the queue Endpoint doesn't refer to azure (xxx.core.windows.net), it will use the local instance of Azurite instead 
with default values
