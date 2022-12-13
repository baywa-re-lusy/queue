<?php

namespace BayWaReLusy\QueueTools\Adapter;

use MicrosoftAzure\Storage\Queue\QueueRestProxy;

class AzuriteAdapter extends AzureAdapterAbstract
{
    public function __construct(
        protected string $accountKey = "Eby8vdM02xNOcqFlqUwJPLlmEtlCDXJ1OUzFT50uSRZ6IFsuFq2UVErCz4I6tq/K1SZFPTOtr/KBHBeksoGMGw==",
        protected string $queueHostname = "http://172.17.0.1",
        protected string $queuePort = "10001",
        protected string $accountName = "devstoreaccount1"
    ) {
    }

    public function getQueueEndpoint(): string
    {
        return sprintf("%s:%s", rtrim($this->queueHostname, '/'), $this->queuePort);
    }

    /**
     * @return QueueRestProxy
     */
    public function getQueueRestProxy()
    {
        if (!$this->queueRestProxy) {
            $this->queueRestProxy = QueueRestProxy::createQueueService(
                sprintf(
                    "DefaultEndpointsProtocol=http;AccountName=%s;AccountKey=%s;QueueEndpoint=%s",
                    $this->accountName,
                    $this->accountKey,
                    $this->getQueueEndpoint()
                )
            );
        }
        return $this->queueRestProxy;
    }
}
