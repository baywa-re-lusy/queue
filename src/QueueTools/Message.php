<?php

/**
 * Message.php
 *
 * @date      29.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      Message.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools;

/**
 * Message
 *
 * @package     BayWaReLusy
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Message
{
    protected ?string $id = null;
    protected string $body;
    protected string $receiptHandle;
    protected \DateTime $insertionDate;
    protected int $dequeueCount;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return Message
     */
    public function setId(?string $id): Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Message
     */
    public function setBody(string $body): Message
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptHandle(): string
    {
        return $this->receiptHandle;
    }

    /**
     * @param string $receiptHandle
     * @return Message
     */
    public function setReceiptHandle(string $receiptHandle): Message
    {
        $this->receiptHandle = $receiptHandle;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInsertionDate(): \DateTime
    {
        return $this->insertionDate;
    }

    /**
     * @param \DateTime $insertionDate
     */
    public function setInsertionDate(\DateTime $insertionDate): void
    {
        $this->insertionDate = $insertionDate;
    }

    /**
     * @return int
     */
    public function getDequeueCount(): int
    {
        return $this->dequeueCount;
    }

    /**
     * @param int $dequeueCount
     * @return Message
     */
    public function setDequeueCount(int $dequeueCount): Message
    {
        $this->dequeueCount = $dequeueCount;
        return $this;
    }
}
