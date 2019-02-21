<?php
namespace MessageBus\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class MessageController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return false|string
     */
    public function postMessage(Request $request, Response $response)
    {
        // store request in our RISK DB Service
        // send request to third party
        // store response to RISK DB Service
        // send response to client if there's a callback or near real-time approach
        return json_encode([
            'data' => [
                'account_no' => $requestData = $request->getParsedBody()['accountno'],
                'message' => 'Processing, we are sending your data to our vendors',
            ]
        ]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return false|string
     */
    public function getMessage(Request $request, Response $response)
    {
        if (empty($request->getParam('accountno'))) {
            return json_encode([
                'errors' => [
                    'title' => 'Invalid param',
                    'detail' => 'Missing account number'
                ]
            ]);
        }

        // send get request to Risk DB Service
        // return response to client
        return json_encode([
            'data' => [
                'account_no' => $request->getParam('accountno'),
                'risk' => 'Medium',
            ]
        ]);
    }
}
