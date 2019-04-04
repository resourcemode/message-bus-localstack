<?php

namespace MessageBus\Command\Sqs;

use Aws\Sqs\SqsClient;

abstract class SqsAbstract implements SqsCommandInterface
{
    /**
     * @var SqsClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $queueUrl = 'http://localhost:4576/queue/1688';

    /**
     * @var array
     */
    protected $params;

    /**
     * SqsAbstract constructor.
     */
    public function __construct()
    {
        $this->client = new SqsClient([
            'profile' => 'default',
            'region' => 'us-east-1',
            'version' => '2012-11-05'
        ]);
    }
}
