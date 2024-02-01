<?php

namespace BayWaReLusy\QueueTools\Test\Adapter;

use Aws\Result;
use BayWaReLusy\QueueTools\Adapter\AwsSqsAdapter;
use PHPUnit\Framework\TestCase;

class AwsSqsAdapterTest extends TestCase
{
    protected AwsSqsAdapter $instance;

    protected function setUp(): void
    {
        $this->instance = new AwsSqsAdapter(
            'region',
            'key',
            'secret',
            'endpoint'
        );
    }

    public function testReceiveMessage(): void
    {
//        $this->sqsClientMock = $this->createMock(SqsClient::class);

        $sqsClientMock = $this
            ->getMockBuilder(SqsClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['receiveMessage'])
            ->getMock();

        $reflectionClass   = new \ReflectionClass(AwsSqsAdapter::class);
        $sqsClientProperty = $reflectionClass->getProperty('sqsClient');
        $sqsClientProperty->setAccessible(true);
        $sqsClientProperty->setValue($this->instance, $sqsClientMock);

        $sentTimestamp = new \DateTime();

        $sqsClientMock
            ->expects($this->once())
            ->method('receiveMessage')
            ->with([
                'QueueUrl' => 'queueUrl',
                'AttributeNames' =>
                    [
                        'SentTimestamp',
                        'ApproximateReceiveCount'
                    ]
            ])
            ->willReturn(new Result([
                'Messages' =>
                    [
                        [
                            'Body'          => 'body',
                            'ReceiptHandle' => 'receipt handle',
                            'Attributes'    =>
                                [
                                    'ApproximateReceiveCount' => 42,
                                    'SentTimestamp'           => intval($sentTimestamp->format('U')) * 1000,
                                ]
                        ]
                    ]
            ]));

        $message = $this->instance->receiveMessage('queueUrl');

        $this->assertEquals('body', $message->getBody());
        $this->assertEquals('receipt handle', $message->getReceiptHandle());
        $this->assertEquals(42, $message->getDequeueCount());
        $this->assertEquals($sentTimestamp->format('U'), $message->getInsertionDate()->format('U'));
    }
}
