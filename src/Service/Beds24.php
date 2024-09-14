<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Beds24
{
    private HttpClientInterface $client;
    private string $baseUri;
    private string $accessToken;
    private string $refreshToken;
    private bool $useLongLifeToken;

    public function __construct(
    ) {}
}