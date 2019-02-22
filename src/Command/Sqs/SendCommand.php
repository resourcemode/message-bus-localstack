<?php

namespace MessageBus\Sqs\Command;

use Aws\Exception\AwsException;

class SendCommand extends SqsAbstract
{
    public function __construct(array $params)
    {
        parent::__construct();
        $this->params = [
            'DelaySeconds' => 10,
            'MessageAttributes' => [
                'accountno' => $params['accountno'],
                'Person' => [
                    'FirstName' => 'Michael',
                    'LastName' => 'Favila'
                ],
            ],
            'MessageBody' => 'Send Profile for client ' . $params['accountno'],
            'QueueUrl' => $this->queueUrl
        ];
    }

    public function message()
    {
        try {
            $result = $this->sendMessage($this->params);
            var_dump($result);
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
    }
}
