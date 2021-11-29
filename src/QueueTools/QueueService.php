<?php

/**
 * QueueService.php
 *
 * @date      29.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      QueueService.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\EmailTools;

use BayWaReLusy\QueueTools\Adapter\PollingQueueAdapterInterface;
use BayWaReLusy\QueueTools\Adapter\QueueAdapterInterface;
use BayWaReLusy\QueueTools\Message;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QueueService
 *
 * @package     BayWaReLusy
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class QueueService
{
    protected QueueAdapterInterface $adapter;
    protected ?OutputInterface $output = null;

    /**
     * Set the adapter.
     *
     * @param QueueAdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(QueueAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return QueueAdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param OutputInterface $output
     * @return QueueService
     */
    public function setOutput(OutputInterface $output): QueueService
    {
        $this->output = $output;
        return $this;
    }

    /**
     * Send a message.
     *
     * @param string $queueUrl
     * @param string $messageBody
     * @param string|null $messageGroupId In case of a FIFO queue, messages can be grouped
     * @param string|null $messageDeduplicationId In case of a FIFO queue, a deduplication ID can be provided
     * @return QueueService Fluent interface
     */
    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ) {
        // Check first if we are running in a console
        if ($this->output) {
            $this->output->writeln((new \DateTime())->format('[c] ') . "Sending a message on $queueUrl ...");
        }

        $this->getAdapter()->sendMessage($queueUrl, $messageBody, $messageGroupId, $messageDeduplicationId);

        return $this;
    }

    /**
     * Receive a message from the given queue.
     *
     * @param string $queueUrl
     * @return Message|null
     * @throws \Exception
     */
    public function receiveMessage(string $queueUrl): ?Message
    {
        // Check first if we are running in a console
        if ($this->output) {
            $this->output->writeln((new \DateTime())->format('[c] ') . "Checking queue for messages on $queueUrl ...");
        }

        $adapter = $this->getAdapter();

        if ($adapter instanceof PollingQueueAdapterInterface) {
            return $adapter->receiveMessage($queueUrl);
        }

        throw new \Exception(sprintf("The queue '%s' is not a polling-type queue.", $queueUrl));
    }

    /**
     * Delete the given message.
     *
     * @param string $queueUrl
     * @param Message $message
     * @return QueueService Fluent interface
     */
    public function deleteMessage(string $queueUrl, Message $message)
    {
        // Check first if we are running in a console
        if ($this->output) {
            $this->output->writeln(
                sprintf(
                    "[%s] Deleting message %s on queue %s ...",
                    (new \DateTime())->format('c'),
                    $message->getReceiptHandle(),
                    $queueUrl
                )
            );
        }

        $this->getAdapter()->deleteMessage($queueUrl, $message);

        return $this;
    }
}
