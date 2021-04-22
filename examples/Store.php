<?php

use Delivery\Client;

class Store {
    const URL = "https://version.aplicativodeentrega.com.br";
    public function createStore()
    {
        $integration = new Client(Ride::URL);

        $data_estimate = $this->getDataFormatedCreateStore();
        $response = $integration->store()->create($data_estimate);

        if ($response->estimate_info->success) {
            // Success response
            return $response;
        } else {
            return $response;
        }
    }
    
    
    private function getDataFormatedCreateStore()
    {
        $user = array(); // inicializando objeto de user caso seja cpfpara enviar
        $institution = array();// inicializando objeto de institution caso seja cnpj para enviar
        $admin = array();// inicializando objeto de admin caso seja cnpj para enviar

        // Verifica primeiro se existe um cnpj cadatrado caso não, irá preencher com cpf
        if (isset($cnpj) && !empty($cnpj)) {
            $person = 2;// tipo cnpj
            $institution = array(
                "name" => "Seu Zé",
                "social_reason" => "Seu Zé",
                "document" => "08585472000165",
                "responsible" => "Seu zé",
                "responsible_position" => "Dono",
                "email" => "seu_zeh@zeh.com",
                "phone" => "8965324512",
                "acknowledgement" => "codificar.com.br",
            );
            $admin = array(
                "username" => "seuzeh123",
                "password" => "123456seuzeh",
                "passwordRepeat" => "123456seuzeh"
            );
        } else if(isset($cpf) && !empty($cpf)) {
            $person = 1; // tipo cpf
            $user = array(
                "name" => "Seu Zé",
                "document" => "08585472000165",
                "email" => "seu_zeh@zeh.com",
                "phone" => "8965324512",
                "acknowledgement" => "codificar.com.br",
                "password" => "123456seuzeh",
                "passwordRepeat" => "123456seuzeh"
            );
        }

        return [
            "person" => $person,
            "show_key_if_exists" => true,
            "user" => $user,
            "institution" => $institution,
            "admin"=> $admin,
            "address" => [
                "street" => "Rua do Seu Zé",
                "zip_code" => "30190050",
                "state" => "Minas Gerais",
                "district" => "Bairro do Seu Zé",
                "city" => "Belo Horizonte",
                "country" => "Brasil",
                "complement" => "Perto da Codificar",
                "number" => "Sem número"
            ]
        ];

    }


}