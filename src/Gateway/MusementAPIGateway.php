<?php

namespace Emilioclemente\TuiApp\Gateway;

use Emilioclemente\TuiApp\Constants\MusementAPIConstants;

class MusementAPIGateway
{
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function getCities()
    {
        return $this->client->get(MusementAPIConstants::BASE_URL.MusementAPIConstants::ENDPOINT_CITIES);
    }
}
