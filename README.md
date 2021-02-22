<p align="center">
  <a href="https://github.com/codificar/delivery-api-php">
    <img alt="Codificar" src="https://codificar.com.br/wp-content/uploads/2019/04/logo-cod.png.webp" width="300">
  </a>
</p>

<h1 align="center">
  <a href="https://github.com/codificar/delivery-api-php">
    API Delivery PHP
  </a>
</h1>
<p align="center">
  Biblioteca desenvolvida pela Codificar .
</p>

<p align="center">
  <a href="https://github.com/facebook/react-native/blob/master/LICENSE">
    <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="React Native is released under the MIT license." />
  </a>
  <a href="https://github.com/codificar/delivery-api-php/releases/">
    <img src="https://img.shields.io/badge/vers%C3%A3o-0.0.1--beta-green" alt="Versão" />
  </a>
  <a href="https://packagist.org/packages/codificar/delivery-api-php">
    <img src="https://img.shields.io/packagist/dt/codificar/delivery-api-php.svg" alt="Downloads" />
  </a>
</p>

# Introdução

Essa SDK foi construída pela Codificar com o intuito de tornar flexível as chamadas dos metodos de entrega, de forma que todos possam utilizar todas as features, de todas as versões de API.

Você pode acessar a documentação oficial da API acessando esse [link](http://app.motoboy.versaoemteste.com.br/api/documentation).

## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Requisição de corrida](#requisição-de-corrida)
  - [Criando uma nova requisiçao buscando um provider próximo](#criando-uma-nova-requisiçao-para-um-provider-próximo)
  - [Gerar estimativa da corrida](#gerar-estimativa-da-corrida)
  - [Detalhes da corrida](#detalhes-da-corrida)
  - [Reenviar uma corrida](#reenviar-uma-corrida)
- [Requisição de store](#requisição-de-store)
  - [Criando uma nova store](#criando-uma-nova-store)

## Instalação

Instale a biblioteca utilizando o comando

`composer require codificar/delivery-api-php`

## Configuração

Para incluir a biblioteca em seu projeto, basta fazer o seguinte:

```php
<?php
require('vendor/autoload.php');

$delivery = new Delivery\Client();
```

### Definindo headers customizados

1. Se necessário for é possível definir headers http customizados para os requests. Para isso basta informá-los durante a instanciação do objeto `Client`:

```php
<?php
require('vendor/autoload.php');

$delivery = new Delivery\Client(
    $base_url,
    ['headers' => ['MEU_HEADER_CUSTOMIZADO' => 'VALOR HEADER CUSTOMIZADO']]
); 
```

E então, você pode poderá utilizar o cliente para fazer requisições ao Delivery da codificar, como nos exemplos abaixo.

## Requisição de corrida

Nesta seção será explicado como realizar requisições de corridas no Delivery com essa biblioteca.

### Criando uma nova requisiçao para um provider próximo

```php
<?php
 $options = [
        'institution_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRING>,
        'provider_type' => <PROVIDER_TYPE:INT>,
        'return_to_start' => <BOOLEAN>,
        'points' => array(
            array(
                'title' => <POINT_A:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'collect_value' => <PAYMENT_TOTAL:FLOAT>,
                'change' => <PAYMENT_CHANGE:FLOAT>,
                'form_of_receipt' => <FORM_OF_RECEIPT:INT('Dinheiro'=1, 'Maquina'=4, 'None'=0)>,
                'collect_pictures' => <BOOLEAN>,
                'collect_signature' => <BOOLEAN>,
                'geometry' => array(
                    'location' => array(
                        'lat' => <LATITUDE:FLOAT>,
                        'lng' => <LONGITUTDE:FLOAT>
                    )
                ),
            'address' => <FULL_ADDRESS:STRING>
            ),
            array(
                'title' => <POINT_A:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'collect_value' => <PAYMENT_TOTAL:FLOAT>,
                'change' => <PAYMENT_CHANGE:FLOAT>,
                'form_of_receipt' => <FORM_OF_RECEIPT:INT('Dinheiro'=1, 'Maquina'=4, 'None'=0)>,
                'collect_pictures' => <BOOLEAN>,
                'collect_signature' => <BOOLEAN>,
                'geometry' => array(
                    'location' => array(
                        'lat' => <LATITUDE:FLOAT>,
                        'lng' => <LONGITUTDE:FLOAT>
                    )
                ),
            'address' => <FULL_ADDRESS:STRING>
            ),
        ),
    ];
$delivery = new Delivery\Client();
$request = $delivery->ride()->create($options);
```

### Gerar estimativa da corrida

Nesta seção será explicado como realizar requisições para estimativas no Delivery com essa biblioteca.

```php
<?php
$options = [
        'institution_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRING>,
        'provider_type' => <PROVIDER_TYPE:INT>,
        'return_to_start' => <BOOLEAN>,
        'points' => array(
            array(
                'title' => <POINT_A:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'geometry' => array(
                    'location' => array(
                        'lat' => <LATITUDE:FLOAT>,
                        'lng' => <LONGITUTDE:FLOAT>
                    )
                ),
            'address' => <FULL_ADDRESS:STRING>
            ),
            array(
                'title' => <POINT_B:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'geometry' => array(
                    'location' => array(
                        'lat' => <LATITUDE:FLOAT>,
                        'lng' => <LONGITUTDE:FLOAT>
                    )
                ),
            'address' => <FULL_ADDRESS:STRING>
            ),
        )
    ];

$delivery = new Delivery\Client();
$estimate = $delivery->ride()->estimate($options);
```
### Detalhes da corrida

Nesta seção será explicado como realizar requisições para obter os detalhes da corrida no Delivery com essa biblioteca.

```php
<?php
$options = [
        'institution_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRING>,
        'id' => <ID_CORRIDA:INT>,
    ];

$delivery = new Delivery\Client();
$estimate = $delivery->ride()->details($options);
```

### Reenviar uma corrida

Nesta seção será explicado como realizar requisições para reenviar uma corrida no Delivery com essa biblioteca.

```php
<?php

$delivery = new Delivery\Client();
$estimate = $delivery->ride()->resend(['request_id' => <ID>]);
```


## Requisição de store

Nesta seção será explicado como realizar requisições para criar uma nova store com essa biblioteca.

### Criando uma nova store

```php
<?php
 $options = [
        "person" => <TYPE_PERSON:INT('Física'=1, 'Jurídica'=2)>,
        "user" => [
            "name" => <NAME:STRING>,
            "document" => <NUMBER_DOCUMENT:STRING>,
            "email" => <EMAIL:STRING>,
            "phone" => <FULL_PHONE:STRING>,
            "password" => <PASSWORD:STRING>,
            "acknowledgement" => <ACKNOWLEDGEMENT:STRING>,
            "confirm_password" => <CONFIRM_PASSWORD:STRING>
        ],
        "address" => [
            "street" => <STREET_STORE:STRING>,
            "zip_code" => <ZIP_CODE:STRING>,
            "state" => <STATE:STRING>,
            "district" => <DISTRICT:STRING>,
            "city" => <CITY:STRING>,
            "country" => <COUNTRY:STRING>,
            "complement" => <COMPLEMENT:STRING>,
            "number" => <NUMBER:STRING>
        ]
    ];
    
$delivery = new Delivery\Client();
$request = $delivery->store()->create($options);
```
