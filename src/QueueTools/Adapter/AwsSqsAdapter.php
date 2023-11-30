<?php

/**
 * AwsSqsAdapter.php
 *
 * @date      29.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      AwsSqsAdapter.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools\Adapter;

use Aws\Sqs\SqsClient;
use BayWaReLusy\QueueTools\Message;

/**
 * AwsSqsAdapter
 *
 * @package    BayWaReLusy
 * @author     Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright  Copyright (c) BayWa r.e. - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class AwsSqsAdapter implements PollingQueueAdapterInterface
{
    protected ?SqsClient $sqsClient = null;

    /**
     * AwsSqsAdapter constructor.
     * @param string $awsRegion
     * @param string $awsKey
     * @param string $awsSecret
     * @param string|null $sqsEndpoint
     */
    public function __construct(
        protected string $awsRegion,
        protected string $awsKey,
        protected string $awsSecret,
        protected ?string $sqsEndpoint = null
    ) {
    }

    private function getSqsClient(): SqsClient
    {
        if (!$this->sqsClient) {
            $parameters =
                [
                    'version'     => '2012-11-05',
                    'region'      => $this->awsRegion,
                    'credentials' =>
                        [
                            'key'    => $this->awsKey,
                            'secret' => $this->awsSecret
                        ]
                ];

            if (!is_null($this->sqsEndpoint)) {
                $parameters['endpoint'] = $this->sqsEndpoint;
            }

            $this->sqsClient = new SqsClient($parameters);
        }

        return $this->sqsClient;
    }

    /**
     * @inheritdoc
     */
    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ): QueueAdapterInterface {
        $params =
            [
                'QueueUrl'    => $queueUrl,
                'MessageBody' => $messageBody,
            ];

        if ($messageGroupId) {
            $params['MessageGroupId'] = $messageGroupId;
        }

        if ($messageDeduplicationId) {
            $params['MessageDeduplicationId'] = $messageDeduplicationId;
        }

        $this->getSqsClient()->sendMessage($params);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function receiveMessage(string $queueUrl): ?Message
    {
        $result = $this->getSqsClient()->receiveMessage(['QueueUrl' => $queueUrl]);

        if (!empty($result['Messages'])) {
            // By default, only one message will be returned
            foreach ($result['Messages'] as $message) {
                $newMessage = new Message();
                $newMessage
                    ->setBody($message['Body'])
                    ->setReceiptHandle($message['ReceiptHandle']);
                return $newMessage;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function deleteMessage(string $queueUrl, Message $message): QueueAdapterInterface
    {
        $this->getSqsClient()->deleteMessage([
            'QueueUrl'      => $queueUrl,
            'ReceiptHandle' => $message->getReceiptHandle()
        ]);

        return $this;
    }
}
