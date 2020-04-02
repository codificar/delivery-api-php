<p align="center">
  <a href="https://github.com/codificar/delivery-api-php">
    <img alt="Codificar" src="https://codificar.com.br/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2019/04/logo-Codificar.png.webp" width="300">
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
    $base_url,
    ['headers' => ['MEU_HEADER_CUSTOMIZADO' => 'VALOR HEADER CUSTOMIZADO']]
); 
```

E então, você pode poderá utilizar o cliente para fazer requisições ao Delivery da codificar, como nos exemplos abaixo.

## Requisição

Nesta seção será explicado como realizar requisições no Delivery com essa biblioteca.

### Criando uma nova requisiçao para um provider próximo

```php
<?php
 $options = [
        'user_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRNIG>,
        'provider_type' => <PROVIDER_TYPE:INT>,
        'points' => array(
            array(
                'title' => 'A',
                'action_type' => 1,
                'action' => 'Deve entregar documento 213123',
                'geometry' => array(
                    'location' => array(
                        'lat' => -19.9224004,
                        'lng' => -43.94055579999997
                    )
                ),
            'address' => 'Rua dos Goitacazes, 374 - Centro, Belo Horizonte - MG, Brasil'
            ),
            array(
                'title' => 'B',
                'action_type' => 1,
                'action' => 'Deve entregar documento 213123',
                'geometry' => array(
                    'location' => array(
                        'lat' => -19.9191953,
                        'lng' => -43.917991400000005
                    )
                ),
                'address' => 'Av. dos Andradas, 500 - Santa Tereza, Belo Horizonte - MG, Brasil'
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
        'user_id' => <USER_ID:INT>,
        'token' => <TOKEN:STRNIG>,
        'provider_type' => <PROVIDER_TYPE:INT>,
        'points' => array(
            array(
                'title' => 'A',
                'action_type' => 1,
                'action' => 'Deve entregar documento 213123',
                'geometry' => array(
                    'location' => array(
                        'lat' => -19.9224004,
                        'lng' => -43.94055579999997
                    )
                ),
            'address' => 'Rua dos Goitacazes, 374 - Centro, Belo Horizonte - MG, Brasil'
            ),
            array(
                'title' => 'B',
                'action_type' => 1,
                'action' => 'Deve entregar documento 213123',
                'geometry' => array(
                    'location' => array(
                        'lat' => -19.9191953,
                        'lng' => -43.917991400000005
                    )
                ),
                'address' => 'Av. dos Andradas, 500 - Santa Tereza, Belo Horizonte - MG, Brasil'
            ),
        )
    ];
$estimate = $delivery->ride()->estimate($options);
```

