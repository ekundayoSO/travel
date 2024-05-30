<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RestCountriesApiService
{
    private $httpClient;
    private $apiUrl = 'https://restcountries.com/v3.1';
    

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getCountries()
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/all');
        return $response->toArray();
    }

    public function getCountryByName($name)
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/name/' . urlencode($name));
        return $response->toArray();
    }

    public function getCountryByCode($capital)
    {
        $response = $this->httpClient->request('GET', $this->apiUrl . '/capital/' . urlencode($capital));
        return $response->toArray();
    }
}
