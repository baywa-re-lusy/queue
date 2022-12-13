<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Message;
use MicrosoftAzure\Storage\Queue\QueueRestProxy;

abstract class AzureAdapterAbstract implements PollingQueueAdapterInterface
{
    protected ?QueueRestProxy $queueRestProxy = null;

    abstract function getQueueRestProxy(): QueueRestProxy;
    public function receiveMessage(string $queueUrl): ?Message
    {
        $listMessagesResult = $this->getQueueRestProxy()->listMessages(
            $queueUrl
        );
        $messages = $listMessagesResult->getQueueMessages();

        foreach ($messages as $message) {
            $msg = new Message();
            $msg->setBody($message->getMessageText());
            $msg->setId($message->getMessageId());
            $msg->setReceiptHandle($message->getPopReceipt());
            return $msg;
        }

        return null;
    }

    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ): AzureAdapterAbstract {
        $this->getQueueRestProxy()->createQueue($queueUrl);
        $this->getQueueRestProxy()->createMessage($queueUrl, $messageBody);
        return $this;
    }

    /**
     * @param string $queueUrl
     * @param Message $message
     * @return AzureAdapterAbstract
     * @throws \Exception
     */
    public function deleteMessage(string $queueUrl, Message $message): AzureAdapterAbstract
    {
        $this->getQueueRestProxy()->deleteMessage($queueUrl, $message->getId(), $message->getReceiptHandle());
        return $this;
    }
}
