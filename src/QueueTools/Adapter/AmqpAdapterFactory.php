<?php

/**
 * AmqpAdapterFactory.php
 *
 * @date      18.04.2022
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      AmqpAdapterFactory.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\QueueToolsConfig;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class AmqpAdapterFactory
 *
 * @package     BayWaReLusy
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class AmqpAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var QueueToolsConfig $config */
        $config = $container->get(QueueToolsConfig::class);

        return new AmqpAdapter(
            $config->getAmqpHostname(),
            $config->getAmqpPort(),
            $config->getAmqpUser(),
            $config->getAmqpPassword()
        );
    }
}
