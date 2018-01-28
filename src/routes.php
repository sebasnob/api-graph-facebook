<?php

$app->get('/', function () {
    $msg = ['info' => [
            'code' => 'Welcome!',
            'message' => 'Try getting a Facebook profile, for example: users/1234',
    ]];

    return $this->response->withJson($msg);
});

$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '18.01']];

    return $this->response->withJson($msg);
});

$app->get('/users/[{name}]', function ($request) {
    $fb = App\facebook::getUser($request, $this->fb);

    if ($fb instanceof Facebook\Exceptions\FacebookResponseException) {
        return $this->response->withJson($fb->getResponseData(), $fb->getHttpStatusCode());
    }
    if ($fb instanceof Facebook\Exceptions\FacebookSDKException) {
        return $this->response->withJson($fb->getResponseData(), $fb->getHttpStatusCode());
    }

    return $this->response->withJson(json_decode($fb->getBody()));
});

$app->get('/pages/[{name}]', function ($request) {
    $fb = App\facebook::getPageFullInfo($request, $this->fb);

    if ($fb instanceof Facebook\Exceptions\FacebookResponseException) {
        return $this->response->withJson($fb->getResponseData(), $fb->getHttpStatusCode());
    }
    if ($fb instanceof Facebook\Exceptions\FacebookSDKException) {
        return $this->response->withJson($fb->getResponseData(), $fb->getHttpStatusCode());
    }

    return $this->response->withJson(json_decode($fb->getBody()));
});
