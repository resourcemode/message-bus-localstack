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
    protected $queueUrl = 'https://sqs.ap-southeast-1.amazonaws.com/272600878028/CLM';

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
            'region' => 'ap-southeast-1',
            'version' => '2012-11-05'
        ]);
    }
}
