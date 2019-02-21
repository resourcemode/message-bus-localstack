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
        if (empty($request->getParam('accountno'))) {
            return json_encode([
                'errors' => [
                    'title' => 'Invalid param',
                    'detail' => 'Missing account number'
                ]
            ]);
        }
        return json_encode([
            'data' => [
                'account_no' => $request->getParam('accountno'),
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
        return json_encode([
            'data' => [
                'account_no' => $request->getParam('accountno'),
                'risk' => 'Medium',
            ]
        ]);
    }
}
