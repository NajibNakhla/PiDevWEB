<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app_settings')]
    public function index(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }


    #[Route('/settings/exchange-rate/{fromCurrency}/{toCurrency}', name: 'exchange_rate')]
    public function getExchangeRate($fromCurrency, $toCurrency): Response
    {
        $apiKey = 'a5ebce9159e44a29bd13b12497391d8b';
        $apiUrl = "https://open.er-api.com/v6/latest/$fromCurrency?apikey=$apiKey";

        try {
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);

            if (isset($data['rates'][$toCurrency])) {
                return $this->json(['exchangeRate' => $data['rates'][$toCurrency]]);
            } else {
                return $this->json(['error' => 'Exchange rate not found'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}




