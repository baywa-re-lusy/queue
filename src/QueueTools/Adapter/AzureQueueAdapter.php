<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Message;
use MicrosoftAzure\Storage\Queue\QueueRestProxy;

class AzureQueueAdapter implements PollingQueueAdapterInterface
{
    public function __construct(
        protected QueueRestProxy $queueRestProxy,
        protected string $queueName
    ) {
    }

    public function receiveMessage(string $queueUrl): ?Message
    {
    }

    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ): QueueAdapterInterface {
        $this->queueRestProxy->createMessage($this->queueName, $messageBody);
        return $this;
    }

    public function deleteMessage(string $queueUrl, Message $message): QueueAdapterInterface
    {
        // TODO: Implement deleteMessage() method.
    }
}