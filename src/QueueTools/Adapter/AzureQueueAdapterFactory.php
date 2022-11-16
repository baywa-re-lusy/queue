<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\QueueToolsConfig;
use Interop\Container\ContainerInterface;
use MicrosoftAzure\Storage\Queue\QueueRestProxy;

class AzureQueueAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        /** @var QueueToolsConfig $config */
        $config = $container->get(QueueToolsConfig::class);

        return new AzureQueueAdapter(
            QueueRestProxy::createQueueService(sprintf(
                "QueueEndpoint=%s;SharedAccessSignature=%s",
                $config->getQueueEndPoint(),
                $config->getAwsKey()
            )),
            $config->getQueueName()
        );
    }
}
