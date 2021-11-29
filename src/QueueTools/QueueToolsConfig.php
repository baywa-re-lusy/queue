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
    protected ?string $awsRegion;
    protected ?string $awsKey;
    protected ?string $awsSecret;

    /**
     * @param string $awsRegion
     * @param string $awsKey
     * @param string $awsSecret
     */
    public function __construct(string $awsRegion, string $awsKey, string $awsSecret)
    {
        $this->awsRegion = $awsRegion;
        $this->awsKey    = $awsKey;
        $this->awsSecret = $awsSecret;
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
}
