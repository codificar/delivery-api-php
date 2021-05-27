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
    <img src="https://img.shields.io/badge/vers%C3%A3o-0.0.2--beta-green" alt="Versão" />
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
  - [Criando uma nova requisição buscando um provider próximo](#criando-uma-nova-requisiçao-para-um-provider-próximo)
  - [Cancelando uma requisição](#cancelando-uma-requisicao)
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

### Criando uma nova requisição para um provider próximo

```php
<?php
 $options = [
        'institution_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRING>,
        'provider_type' => <PROVIDER_TYPE:INT>,
        'payment_mode' => <PAYMENT_MODE:INT>,
        'return_to_start' => <BOOLEAN>,
        'points' => array(
            array(
                'title' => <POINT_A:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'collect_value' => <COLLECT_VALUE:FLOAT>,
                'change' => <CHANGE:FLOAT>,
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
                'title' => <POINT_B:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'collect_value' => <COLLECT_VALUE:FLOAT>,
                'change' => <CHANGE:FLOAT>,
                'form_of_receipt' => <FORM_OF_RECEIPT:INT('Dinheiro'=1, 'Maquina'=4, 'None'=0)>,
                'collect_pictures' => <BOOLEAN>,
                'collect_signature' => <BOOLEAN>,
                'order_id' => <ORDER_ID>,
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

### Cancelando uma requisição

```php
<?php
 $options = [
        'institution_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRING>,
        'request_id' => <REQUEST_ID:INT>,
        'reason' => <REASON:STRING>
    ];
$delivery = new Delivery\Client();
$request = $delivery->ride()->cancel($options);
```

### Gerar estimativa da corrida

Nesta seção será explicado como realizar requisições para estimativas no Delivery com essa biblioteca.

```php
<?php
$options = [
        'institution_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRING>,
        'provider_type' => <PROVIDER_TYPE:INT>,
        'payment_mode' => <PAYMENT_MODE:INT>,
        'return_to_start' => <BOOLEAN>,
        'points' => array(
            array(
                'title' => <POINT_A:STRING>,
                'action_type' => <ACTION_TYPE:INT>,
                'action' => <ACTION:STRING>,
                'collect_value' => <COLLECT_VALUE:FLOAT>,
                'change' => <CHANGE:FLOAT>,
			          'form_of_receipt' => <FORM_OF_RECEIPT:STRING>('Dinheiro'=1, 'Maquina'=4, 'None'=0)>,
			          'collect_pictures' => <BOOLEAN|DEFAULT: false>,
			          'collect_signature' => <BOOLEAN|DEFAULT: false>,
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
                'collect_value': <COLLECT_VALUE:INT>,
			          'change': <NULL>,
			          'form_of_receipt': <FORM_OF_RECEIPT:STRING>('Dinheiro'=1, 'Maquina'=4, 'None'=0)>,
			          'collect_pictures': <BOOLEAN|DEFAULT: false>,
			          'collect_signature': <BOOLEAN|DEFAULT: false>,
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

#### Do tipo Pessoa Física

```php
<?php
 $options = [
        "person" => <TYPE_PERSON:INT('Física'=1, 'Jurídica'=2)>,
        "show_key_if_exists" => <BOOLEAN|DEFAULT: false>,
        "user" => [
            "name" => <NAME:STRING>,
            "document" => <NUMBER_DOCUMENT:STRING>,
            "email" => <EMAIL:STRING>,
            "phone" => <FULL_PHONE:STRING>,
            "password" => <PASSWORD:STRING>,
            "passwordRepeat" => <PASSWORD_REPEAT:STRING>,
            "acknowledgement" => <ACKNOWLEDGEMENT:STRING>,
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
?>
```

#### Do tipo Pessoa Jurídica

``` php
<?php
 $options = [
        "person" => <TYPE_PERSON:INT('Física'=1, 'Jurídica'=2)>,
        "show_key_if_exists" => <BOOLEAN|DEFAULT: false>,
        "institution" => [
            "name" => <NAME:STRING>,
            "social_reason" => <SOCIAL_REASON:STRING>,
            "document" => <NUMBER_DOCUMENT:STRING>,
            "responsible" => <RESPONSIBLE:STRING>,
            "responsible_position" => <RESPONSIBLE_POSITION:STRING>,
            "email" => <EMAIL:STRING>,
            "phone" => <FULL_PHONE:STRING>,
            "acknowledgement" => <ACKNOWLEDGEMENT:STRING>,
        ],
        "admin" => [
            "username" => <USERNAME:STRING>,
            "password" => <PASSWORD:STRING>,
            "passwordRepeat" => <PASSWORD_REPEAT:STRING>,

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
?>
```

 Agora envie a solicitação com a `$options` desejada.
``` php
<?php
$delivery = new Delivery\Client();
$request = $delivery->store()->create($options);
?>
```
