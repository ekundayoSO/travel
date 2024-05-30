<?php


namespace App\Controller;

use App\Service\RestCountriesApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class TripCountryController extends AbstractController
{
    private $restCountriesApiService;

    public function __construct(RestCountriesApiService $restCountriesApiService)
    {
        $this->restCountriesApiService = $restCountriesApiService;
    }

    
    #[Route("/countries", name: "countries_list")]
    public function list(): Response
    {
        $countries = $this->restCountriesApiService->getCountries();
        return $this->json($countries);
    }

    
    #[Route("/countries/{name}", name: "country_by_name")]
    public function getCountryByName(string $name): Response
    {
        $country = $this->restCountriesApiService->getCountryByName($name);
        return $this->json($country);
    }

    
    #[Route("/countries/code/{code}", name: "country_by_code")]
    public function getCountryByCode(string $code): Response
    {
        $country = $this->restCountriesApiService->getCountryByCode($code);
        return $this->json($country);
    }
}
