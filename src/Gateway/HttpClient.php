<?php

namespace Emilioclemente\TuiApp\Gateway;

class HttpClient
{
    public function get(string $url, array $params = []): array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);

        curl_close($ch);

        return json_decode($res, true);
    }
}
