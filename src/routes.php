<?php

use Slim\Http\Request;
use Slim\Http\Response;
use MessageBus\Controller\MessageController;

// Routes
$app->post(
    '/message',
    MessageController::class . ':postMessage'
);
$app->get(
    '/message',
    MessageController::class . ':getMessage'
);
$app->add(function (Request $req, Response $res, $next) {
    $this->logger->info("Message '/' route");
    $response = $next($req, $res);
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
