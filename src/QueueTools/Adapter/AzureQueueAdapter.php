<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Message;
use MicrosoftAzure\Storage\Queue\QueueRestProxy;

class AzureQueueAdapter implements PollingQueueAdapterInterface
{
    protected string $accountKey;

    public function __construct(
        protected string $queueEndPoint,
        protected ?string $sasToken = null,
        string $accountKey = "Eby8vdM02xNOcqFlqUwJPLlmEtlCDXJ1OUzFT50uSRZ6IFsuFq2UVErCz4I6tq/K1SZFPTOtr/KBHBeksoGMGw==",
        protected string $accountName = "devstoreaccount1"
    ) {
        $this->accountKey = $accountKey;
    }

    /**
     * @return QueueRestProxy
     */
    public function getQueueRestProxy(): QueueRestProxy
    {
        if (!$this->queueRestProxy) {
            //if the url contains the official azure's URL
            if (str_contains($this->queueEndPoint, "core.windows.net")) {
                $this->queueRestProxy = QueueRestProxy::createQueueService(sprintf(
                    "QueueEndpoint=%s;SharedAccessSignature=%s",
                    $this->queueEndPoint,
                    $this->sasToken
                ));
            } else {
                $this->queueRestProxy = QueueRestProxy::createQueueService(
                    sprintf(
                        "DefaultEndpointsProtocol=http;AccountName=%s;AccountKey=%s;QueueEndpoint=%s/%s",
                        $this->accountName,
                        $this->accountKey,
                        $this->queueEndPoint,
                        $this->accountName
                    )
                );
            }
        }
        return $this->queueRestProxy;
    }

    protected ?QueueRestProxy $queueRestProxy = null;

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
            $msg->setInsertionDate($message->getInsertionDate());
            return $msg;
        }

        return null;
    }

    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ): AzureQueueAdapter {
        $this->getQueueRestProxy()->createQueue($queueUrl);
        $this->getQueueRestProxy()->createMessage($queueUrl, $messageBody);
        return $this;
    }

    /**
     * @param string $queueUrl
     * @param Message $message
     * @return AzureQueueAdapter
     * @throws \Exception
     */
    public function deleteMessage(string $queueUrl, Message $message): AzureQueueAdapter
    {
        $this->getQueueRestProxy()->deleteMessage($queueUrl, $message->getId(), $message->getReceiptHandle());
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function changeMessageVisibility(
        string $queueUrl,
        Message $message,
        int $visibilityTimeout
    ): QueueAdapterInterface {
        throw new \Exception('Not yet implemented');
    }
}
