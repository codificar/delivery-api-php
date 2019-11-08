# delivery-api-php


# Introdução

Essa SDK foi construída pela Codificar com o intuito de tornar flexível as chamadas dos metodos de entrega, de forma que todos possam utilizar todas as features, de todas as versões de API.

Você pode acessar a documentação oficial da API acessando esse [link](http://app.motoboy.versaoemteste.com.br/api/documentation).

## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Requisição](#requisição)
  - [Criando uma nova requisiçao buscando um para próximo](#criando-uma-nova-requisiçao-para-um-provider-próximo)
- [Estimar](#estimar)
  - [Gerar estimativa da corrida](#gerar-estimativa-da-corrida)
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
    ['headers' => ['MEU_HEADER_CUSTOMIZADO' => 'VALOR HEADER CUSTOMIZADO']]
); 
```

### Definindo Modo Teste

1. Se necessário for é possível definir modo teste para os requests. Para isso basta informá-los durante a instanciação do objeto `Client`, observando que a se não tiver header definir como null:

```php
<?php
require('vendor/autoload.php');

$delivery = new Delivery\Client(
    null, true
); 
```

### Definindo modo teste com headers customizados

1. Se necessário for é possível definir headers http customizados com o modo teste para os requests. Para isso basta informá-los durante a instanciação do objeto `Client`:

```php
<?php
require('vendor/autoload.php');

$delivery = new Delivery\Client(
    ['headers' => ['MEU_HEADER_CUSTOMIZADO' => 'VALOR HEADER CUSTOMIZADO']],
    true
); 
```

E então, você pode poderá utilizar o cliente para fazer requisições ao Delivery da codificar, como nos exemplos abaixo.

## Requisição

Nesta seção será explicado como realizar requisições no Delivery com essa biblioteca.

### Criando uma nova requisiçao para um provider próximo

```php
<?php
 $options = [
        "user_id" => 35,
        "token" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee",
        'provider_type' => 22,
        'points' => array(
            array(
                "title" => "A",
                "action_type" => 1,
                "action" => "Deve entregar documento 213123",
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

$request = $delivery->ride()->create($options);
```

## Estimar

Nesta seção será explicado como realizar requisições para estimativas no Delivery com essa biblioteca.

### Gerar estimativa da corrida

```php
<?php
$options = [
        "user_id" => 35,
        "token" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee",
        'type' => 22,
        'points' => array(
            array(
                "title" => "A",
                "action_type" => 1,
                "action" => "Deve entregar documento 213123",
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
                "geometry" => array(
                    "location" => array(
                        "lat" => -19.9191953,
                        "lng" => -43.917991400000005
                    )
                ),
                "address" => "Av. dos Andradas, 500 - Santa Tereza, Belo Horizonte - MG, Brasil"
            ),
        )
    ];
$estimate = $delivery->ride()->estimate($options);
```

