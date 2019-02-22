<?php
namespace MessageBus\Sqs\Command;

use Aws\Exception\AwsException;

class ReceiveCommand extends SqsAbstract
{
    public function __construct(array $params)
    {
        parent::__construct();
        $this->params = $params;
    }

    public function message()
    {
        try {
            $result = $this->client->receiveMessage(array(
                'AttributeNames' => ['SentTimestamp'],
                'MaxNumberOfMessages' => 1,
                'MessageAttributeNames' => ['All'],
                'QueueUrl' => $this->queueUrl, // REQUIRED
                'WaitTimeSeconds' => 0,
            ));
            if (count($result->get('Messages')) > 0) {
                var_dump($result->get('Messages')[0]);
                $result = $this->client->deleteMessage([
                    'QueueUrl' => $this->queueUrl, // REQUIRED
                    'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle'] // REQUIRED
                ]);
            } else {
                echo "No messages in queue. \n";
            }
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
    }
}
