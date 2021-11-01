<?php

namespace Emilioclemente\TuiApp\Gateway;

use Emilioclemente\TuiApp\Constants\MusementAPIConstants;

class MusementAPIGateway
{
    private HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return array<integer, mixed>
     */
    public function getCities(): array
    {
        return $this->client->get(MusementAPIConstants::BASE_URL.MusementAPIConstants::ENDPOINT_CITIES);
    }
}
