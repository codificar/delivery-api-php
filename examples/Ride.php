<?php

use Delivery\Client;

class Ride {
    const URL = "https://version.aplicativodeentrega.com.br";
    public function estimateRide()
    {
        $integration = new Client(Ride::URL);

        $data_estimate = $this->getDataFormatedEstimateAndCreate();
        $response = $integration->ride()->estimate($data_estimate);

        if (isset($response->estimate_info->success) && 
            $response->estimate_info->success) {
            // Success response
            if(!$response->estimate_info->maximum_distance) {
                // get estimated value price
                return $response;
            } else {
                // Distance exceded
            }
        }
    } 

    public function createRide()
    {
        $integration = new Client(Ride::URL);

        $data_create = $this->getDataFormatedEstimateAndCreate();
        $response = $integration->ride()->create($data_create);


        if ($response->estimate_info->success) {
            //Susccess response
            return $response;

        } else {
           // error return
           $errors = '';
           if (isset($response->errors) && !empty($response->errors)) {
               foreach($response->errors as $err) {
                   $errors .= $err . "\n";
               }
           }
           if (isset($response->error) && !empty($response->error)) {
                   $errors .= $response->error;
           }

           return $errors;

        }
    } 

    public function detailRide()
    {
        $details_data_request = [
            "institution_id" => 1,
            "token" => "$2y$10$8Pyc2uwCSdY4AQ1YymR11.X0P990rbeyXUy39TO7UzoFBux5zMN66",
            "id" => 1033
        ];

        $client = new Client(Ride::URL);
        $response = $client->ride()->details($details_data_request);


        if (isset($response) && !empty($response)) {
            if ($response->success) { 
                // response success
            } else {
                // response error
            }
        } else {
            // error no data response
        }
    }
    
    public function resendRide()
    {
        $client = new Client(Ride::URL);
        $response = $client->ride()->resend(["request_id" => 1033]);

        if ($response->success) { 
            // response success
        } else {
            // response error
        }
    }

    public function getTypeService()
    {
        $domain = "";
        $client = new Client($domain);
        $response = $client->ride()->typesService(["platform" => "codificar"]);

        if ($response->success) { 
            // response success
        } else {
            // response error
        }
    }


    private function getDataFormatedEstimateAndCreate()
    {
        return [
            "institution_id" => 1,
            "token" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee",
            "provider_type" => 22,
            "payment_mode" => 5,
            "return_to_start" => true,
            'points' => array(
                array(
                    "title" => "A",
                    "action_type" => 1,
                    "action" => "Deve entregar documento 213123",
                    "collect_value" => 0,
                    "change" => null,
                    "form_of_receipt" => null,
                    "collect_pictures" => false,
                    "collect_signature" => false,
                    "geometry" => array(
                        "location" => array(
                            "lat" => -19.9224004,
                            "lng" => -43.94055579999997
                        )
                    ),
                "address" => "Rua dos Goitacazes, 374 - Centro, Belo Horizonte - MG, Brasil"
                ),
                array(
                    "title" => "B",
                    "action_type" => 1,
                    "action" => "Deve entregar documento 213123",
                    "collect_value" => 18,
                    "change" => null,
                    "form_of_receipt" => "1",
                    "collect_pictures" => false,
                    "collect_signature" => false,
                    "order_id" => "244",
                    "geometry" => array(
                        "location" => array(
                            "lat" => -19.9191953,
                            "lng" => -43.917991400000005
                        )
                    ),
                    "address" => "Av. dos Andradas, 500 - Santa Tereza, Belo Horizonte - MG, Brasil"
                ),
            ),
        ];
    }


}
