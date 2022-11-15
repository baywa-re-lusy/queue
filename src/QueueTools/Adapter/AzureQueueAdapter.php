<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Message;

class AzureQueueAdapter implements PollingQueueAdapterInterface
{
    public function receiveMessage(string $queueUrl): ?Message
    {
        // TODO: Implement receiveMessage() method.
    }

    public function sendMessage(string $queueUrl, string $messageBody, string $messageGroupId = null, string $messageDeduplicationId = null): QueueAdapterInterface
    {
        // TODO: Implement sendMessage() method.
    }

    public function deleteMessage(string $queueUrl, Message $message): QueueAdapterInterface
    {
        // TODO: Implement deleteMessage() method.
    }
}