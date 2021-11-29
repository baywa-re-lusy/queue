<?php

/**
 * QueueTools.php
 *
 * @date        29.11.2021
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file        QueueTools.php
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools;

use Laminas\ServiceManager\ServiceManager;

/**
 * Class QueueTools
 *
 * Entry-point to use the tool-set
 *
 * @package     BayWaReLusy
 * @subpackage  QueueTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class QueueTools extends ServiceManager
{
    public function __construct(QueueToolsConfig $config)
    {
        $services = require __DIR__ . '/../../config/module.config.php';
        parent::__construct($services['service_manager']);

        $this->setService(QueueToolsConfig::class, $config);
    }
}
