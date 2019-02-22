<?php

namespace MessageBus\Command\Sqs;

use Aws\Exception\AwsException;

class SendCommand extends SqsAbstract
{
    public function __construct(array $params)
    {
        parent::__construct();
        $this->params = [
            'DelaySeconds' => 2,
            'MessageAttributes' => [
                'accountno' => [
                    'DataType' => 'String',
                    'StringValue' => (string) $params['accountno']
                ],
                'Person' => [
                    'DataType' => 'String',
                    'StringValue' => 'Luke',
                ],
            ],
            'MessageBody' => 'Send Profile for client ' . $params['accountno'],
            'QueueUrl' => $this->queueUrl
        ];
    }

    public function message()
    {
        try {
            $result = $this->client->sendMessage($this->params);
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
            $result = $e->getMessage();
        }

        file_put_contents('senddummydata.txt', $result);
        return $result;
    }
}
