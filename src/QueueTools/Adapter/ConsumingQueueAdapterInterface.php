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

/**
 * ConsumingQueueAdapterInterface
 *
 * @package     BayWaReLusy
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface ConsumingQueueAdapterInterface extends QueueAdapterInterface
{
    /**
     * Consume the queue.
     *
     * @param string $queueUrl
     * @param callable $callback
     */
    public function consumeQueue(string $queueUrl, callable $callback): void;
}
