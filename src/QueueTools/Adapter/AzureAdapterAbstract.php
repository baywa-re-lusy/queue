<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Message;

abstract class AzureAdapterAbstract implements PollingQueueAdapterInterface
{
    public function __construct(
        protected QueueRestProxy $queueRestProxy,
        protected string $queueName
    ) {
    }

    public function receiveMessage(string $queueUrl): ?Message
    {
        $listMessagesResult = $this->queueRestProxy->listMessages(
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
        $this->queueRestProxy->createQueue($queueUrl);
        $this->queueRestProxy->createMessage($queueUrl, $messageBody);
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
        $this->queueRestProxy->deleteMessage($queueUrl, $message->getId(), $message->getReceiptHandle());
        return $this;
    }
}