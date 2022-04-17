<?php

/**
 * RabbitMQAdapter.php
 *
 * @date      18.04.2022
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      RabbitMQAdapter.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Message;
use BayWaReLusy\QueueTools\QueueException;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * AwsSqsAdapter
 *
 * @package    BayWaReLusy
 * @author     Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright  Copyright (c) BayWa r.e. - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class RabbitMQAdapter implements ConsumingQueueAdapterInterface
{
    public function __construct(
        protected string $hostname
    )
    {
    }


    /**
     * @inheritDoc
     */
    public function consumeQueue(string $queueUrl, callable $callback): void
    {
        $connection = new AMQPStreamConnection($this->hostname, 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare($queueUrl, false, false, false, false);
        $channel->basic_consume($queueUrl, '', false, true, false, false, $callback);

        while ($channel->is_open()) {
            echo 'test' . "\n";
            $channel->wait();
        }
    }

    /**
     * @inheritDoc
     */
    public function sendMessage(string $queueUrl, string $messageBody, string $messageGroupId = null, string $messageDeduplicationId = null): QueueAdapterInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function deleteMessage(string $queueUrl, Message $message): QueueAdapterInterface
    {
        return $this;
    }
}
