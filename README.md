# Irene Server [![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/4a15944cf8740f934549#?env%5BIrene%20-%20Local%5D=W3sia2V5IjoiYmFzZV91cmwiLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWV9LHsia2V5IjoiZGlhbG9nZmxvd190b2tlbiIsInZhbHVlIjoiIiwiZW5hYmxlZCI6dHJ1ZX0seyJrZXkiOiJwdXNoYnVsbGV0X3Rva2VuIiwidmFsdWUiOiIiLCJlbmFibGVkIjp0cnVlfSx7ImtleSI6InB1c2hidWxsZXRfYWNjZXNzX3Rva2VuIiwidmFsdWUiOiIiLCJlbmFibGVkIjpmYWxzZX1d)
[![Build Status](https://travis-ci.org/apquinit/irene-server.svg?branch=master)](https://travis-ci.org/apquinit/irene-server)

Irene Server is a server application that handles requests and webhooks of Irene artificial intelligence assistant.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

#### Server Requirements

```
PHP >= 7.1.3
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension
Ctype PHP Extension
JSON PHP Extension
BCMath PHP Extension
```

#### Service Requirements (API Accounts and Keys)

```
Dark Sky
LocationIQ
Pushbullet
WolframAlpha
TimezoneDB
```

### Installing

Clone the repository.

```
git clone https://github.com/apquinit/irene-server.git
```

Install dependencies.

```
composer install
```

Generate .env file.

```
cp .env.example .env
```

Set application key.

```
php artisan key:generate
```

After installation, populate .env file with the database details and personal API keys.

## Running the tests

### Unit tests

```
vendor\bin\phpunit --testdox 
```

### Coding style tests

```
vendor/bin/phpcs --config-set show_warnings 0
vendor/bin/phpcs --standard=PSR2 --extensions=php --ignore=*/routes/*,*/migrations/*,*/tests/* app
```

## Deployment

Coming soon!

For reference, please visit deployed sample in [Heroku](https://irene-server.herokuapp.com/).
Also, feel free to chat Irene on Facebook [Messenger](https://www.facebook.com/irene.artificial.intelligence.assistant.lite/)!

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
