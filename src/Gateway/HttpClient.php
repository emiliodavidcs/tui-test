<?php

namespace Emilioclemente\TuiApp\Gateway;

use Exception;

class HttpClient
{
    /**
     * @param array<string, mixed> $params
     * @return array<integer|string, mixed>
     */
    public function get(string $url, array $params = []): array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);

        curl_close($ch);

        if (!$res) {
            throw new Exception('An error occurred trying to connect to third party API');
        }

        return json_decode($res, true);
    }
}
