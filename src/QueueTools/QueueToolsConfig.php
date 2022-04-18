<?php
/**
 * QueueToolsConfig.php
 *
 * @date        29.11.2021
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file        QueueToolsConfig.php
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\QueueTools;

/**
 * Class QueueToolsConfig
 *
 * Config object for QueueTools
 *
 * @package     BayWaReLusy
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class QueueToolsConfig
{
    /**
     * @param string|null $awsRegion
     * @param string|null $awsKey
     * @param string|null $awsSecret
     * @param string|null $amqpHostname
     * @param int|null $amqpPort
     * @param string|null $amqpUser
     * @param string|null $amqpPassword
     */
    public function __construct(
        protected ?string $awsRegion,
        protected ?string $awsKey,
        protected ?string $awsSecret,
        protected ?string $amqpHostname,
        protected ?int $amqpPort,
        protected ?string $amqpUser,
        protected ?string $amqpPassword
    ) {
    }

    /**
     * @return string|null
     */
    public function getAwsRegion(): ?string
    {
        return $this->awsRegion;
    }

    /**
     * @return string|null
     */
    public function getAwsKey(): ?string
    {
        return $this->awsKey;
    }

    /**
     * @return string|null
     */
    public function getAwsSecret(): ?string
    {
        return $this->awsSecret;
    }

    /**
     * @return string|null
     */
    public function getAmqpHostname(): ?string
    {
        return $this->amqpHostname;
    }

    /**
     * @return int|null
     */
    public function getAmqpPort(): ?int
    {
        return $this->amqpPort;
    }

    /**
     * @return string|null
     */
    public function getAmqpUser(): ?string
    {
        return $this->amqpUser;
    }

    /**
     * @return string|null
     */
    public function getAmqpPassword(): ?string
    {
        return $this->amqpPassword;
    }
}
