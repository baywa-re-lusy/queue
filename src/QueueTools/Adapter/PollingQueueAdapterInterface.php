<?php

/**
 * PollingQueueAdapterInterface.php
 *
 * @date      29.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PollingQueueAdapterInterface.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapter\Message;

/**
 * PollingQueueAdapterInterface
 *
 * @package     BayWaReLusy
 * @subpackage  QueueTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface PollingQueueAdapterInterface extends QueueAdapterInterface
{
    /**
     * Receive a message.
     *
     * @param string $queueUrl
     * @return Message
     */
    public function receiveMessage(string $queueUrl): ?Message;
}
