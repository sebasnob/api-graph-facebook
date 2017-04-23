<?php

/**
 * Class facebook to use the Facebook API Graph.
 */
class facebook
{
    public static function getUser($request, $fb)
    {
        try {
            $name = $request->getAttribute('name');
            $url = sprintf('/%s?fields=id,first_name,last_name', $name);
            $facebookResponse = $fb->get($url, $fb->getApp()->getAccessToken());
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            http_response_code($e->getHttpStatusCode());
            echo json_encode($e->getResponseData(), JSON_PRETTY_PRINT);
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            http_response_code($e->getHttpStatusCode());
            echo json_encode($e->getResponseData(), JSON_PRETTY_PRINT);
            exit;
        }

        return $facebookResponse;
    }

    public static function getPageFullInfo($request, $fb)
    {
        try {
            $name = $request->getAttribute('name');
            $url = sprintf('/%s?fields=id,name,about,likes,link', $name);
            $facebookResponse = $fb->get($url, $fb->getApp()->getAccessToken());
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            http_response_code($e->getHttpStatusCode());
            echo json_encode($e->getResponseData(), JSON_PRETTY_PRINT);
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            http_response_code($e->getHttpStatusCode());
            echo json_encode($e->getResponseData(), JSON_PRETTY_PRINT);
            exit;
        }

        return $facebookResponse;
    }
}
