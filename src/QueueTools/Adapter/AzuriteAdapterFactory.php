<?php

namespace BayWaReLusy\QueueTools\Adapter;

use BayWaReLusy\QueueTools\QueueToolsConfig;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use MicrosoftAzure\Storage\Queue\QueueRestProxy;

class AzuriteAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        /** @var QueueToolsConfig $config */
        $config = $container->get(QueueToolsConfig::class);
        //TODO How to use the docker name instead of an address? name in docker compose does not work
        //Accountkey and accountname are the Azurite default
        return new AzureQueueAdapter(
            QueueRestProxy::createQueueService(
                "DefaultEndpointsProtocol=http;AccountName=devstoreaccount1;AccountKey=Eby8vdM02xNOcqFlqUwJPLlmEtlCDXJ1OUzFT50uSRZ6IFsuFq2UVErCz4I6tq/K1SZFPTOtr/KBHBeksoGMGw==;BlobEndpoint=http://172.17.0.1:10000/devstoreaccount1;QueueEndpoint=http://172.17.0.1:10001/devstoreaccount1;"
            ),
            $config->getQueueName()
        );
    }
}
