<?php
namespace MessageBus\Command\Sqs;

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
                // get
                $testingResult = $result->get('Messages')[0];
                // delete
                $this->client->deleteMessage([
                    'QueueUrl' => $this->queueUrl, // REQUIRED
                    'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle'] // REQUIRED
                ]);

            } else {
                $testingResult = "No messages in queue. \n";
            }
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
            $testingResult = $e->getMessage();
        }

        file_put_contents('receivedummydata.txt', $result);
        return $testingResult;
    }
}
