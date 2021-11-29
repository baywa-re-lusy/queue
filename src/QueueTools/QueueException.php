<?php

namespace BayWaReLusy\QueueTools;

class QueueException extends \Exception
{
    protected int $httpErrorCode;
    protected string $httpErrorMessage;

    /**
     * @param int $httpErrorCode
     * @param string $httpErrorMessage
     */
    public function __construct(int $httpErrorCode, string $httpErrorMessage)
    {
        $this->httpErrorCode    = $httpErrorCode;
        $this->httpErrorMessage = $httpErrorMessage;
    }
}
