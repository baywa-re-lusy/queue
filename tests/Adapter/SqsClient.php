<?php

namespace BayWaReLusy\QueueTools\Test\Adapter;

use Aws\Result;

class SqsClient extends \Aws\Sqs\SqsClient
{
    public function receiveMessage(array $args = []): Result
    {
        return new Result();
    }
}
