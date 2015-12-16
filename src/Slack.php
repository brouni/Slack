<?php

namespace CJSDevelopment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Slack
 * @package CJSDevelopment
 */
class Slack
{
    /**
     * @param $message
     * @param null $channel = chanel where the message get's send to
     * @param null $username = under what username the message get's send to
     * @param null $icon = the icon that is displayed by the message
     * @return bool
     */
    public static function sendMessage($message, $channel = null, $username = null, $icon = null) {
        $data = self::getPayload($message, $channel, $username, $icon);

        $dataClient = new Client();

        $dT = $dataClient->post(config("slack.url"), ["body" => json_encode($data)]);

        if ($dT->getStatusCode() != 200) {
            return false;
        }
        return true;
    }

    /**
     * @param $message
     * @param null $channel = chanel where the message get's send to
     * @param null $username = under what username the message get's send to
     * @param null $icon = the icon that is displayed by the message
     * @return mixed
     */
    private static function getPayload($message, $channel = null, $username = null, $icon = null) {
        $object["channel"]      = is_null($channel) ? config("slack.channel") : $channel;
        $object["username"]     = is_null($username) ? config("slack.username") : $username;
        $object["icon_emoji"]   = is_null($icon) ? config("slack.icon") : $icon;
        $object["text"]         = $message;

        return $object;

    }


}
