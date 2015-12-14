<?php

namespace CJSDevelopment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Slack
{
    public static function sendMessage($message) {
        $data = self::_getPayload($message);

        $dataClient = new Client();

        $dT = $dataClient->post(config("slack.url"), [json_encode($data)]);

        if ($dT->getStatusCode() != 200) {
            return false;
        }
        return true;
    }

    private static function _getPayload($message) {
        $object["payload"]["username"] = config("slack.username");
        $object["payload"]["icon_emoji"] = config("slack.icon");
        $object["payload"]["channel"] = config("slack.channel");
        $object["payload"]["text"] = $message;

        return $object;

    }


}