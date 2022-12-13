<?php

namespace BayWaReLusy\QueueTools\Adapter;

use MicrosoftAzure\Storage\Queue\QueueRestProxy;

class AzureQueueAdapter extends AzureAdapterAbstract
{
    public function __construct(
        protected string $sasToken,
        protected string $queueEndPoint,
    ) {
    }

    /**
     * @return QueueRestProxy
     */
    public function getQueueRestProxy(): QueueRestProxy
    {
        if (!$this->queueRestProxy) {
            $this->queueRestProxy = QueueRestProxy::createQueueService(sprintf(
                "QueueEndpoint=%s;SharedAccessSignature=%s",
                $this->queueEndPoint,
                $this->sasToken
            ));
        }
        return $this->queueRestProxy;
    }
}
