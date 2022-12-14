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

$adapter = new AwsSqsAdapter($awsRegion, $awsKey, $awsSecret);
$queueService = new QueueService($adapter);
```
#### Azure
```php
use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AzureQueueAdapter;

$adapter = new AzureQueueAdapter($sasToken, $queueEndpoint);
$queueService = new QueueService($adapter);
```

There also is an Azurite adapter for local testing of the Azure Queue

```php
use BayWaReLusy\QueueTools\QueueService;
use BayWaReLusy\QueueTools\Adapter\AzuriteAdapter;

$adapter = new AzuriteAdapter();
$queueService = new QueueService($adapter);
```
The adapter takes 4 optionals parameters, if the config varies from the default, it must be given in the constructor

Here are the default values
```php
string $accountKey = "Eby8vdM02xNOcqFlqUwJPLlmEtlCDXJ1OUzFT50uSRZ6IFsuFq2UVErCz4I6tq/K1SZFPTOtr/KBHBeksoGMGw==",
string $queueHostname = "http://172.17.0.1",
string $queuePort = "10001",
string $accountName = "devstoreaccount1"
```

