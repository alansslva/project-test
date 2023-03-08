<?php

namespace App\Infra\Common\Http;

class Http
{

   protected string $baseUrl;

    private function httpRequest(string $method = 'GET', array $params = []) : string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "$this->baseUrl",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $params,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception('Integration Exception');
        }

        else {
            return  $response;
        }
    }
    public function get(string $route)
    {
        $this->baseUrl = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
        return $this->httpRequest('GET');
    }

    public function post(string $route, array $params)
    {

    }
}
