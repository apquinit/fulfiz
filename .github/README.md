# Irene Server 

[![Build Status](https://travis-ci.org/apquinit/irene-server.svg?branch=master)](https://travis-ci.org/apquinit/irene-server)

Irene Server is a server application that handles requests and webhooks of Irene artificial intelligence assistant.

## Prerequisites

### Server Requirements

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

### Service Requirements (API Accounts and Keys)

```
Dark Sky
LocationIQ
Pushbullet
WolframAlpha
TimezoneDB
```

## Installation

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

After installation, populate the .env file with the database and API credentials.

## Testing

### Unit tests

```
vendor/bin/phpunit --testdox 
```

### Coding style tests

```
vendor/bin/phpcs --config-set show_warnings 0
vendor/bin/phpcs --standard=PSR2 --extensions=php --ignore=*/routes/*,*/migrations/*,*/tests/* app
```

## License

Irene Server is licensed under the GPL-3.0 License - see the [LICENSE](/LICENSE) file for details.

## Additional Notes

For reference, explore the project's Postman [collection](https://app.getpostman.com/run-collection/4a15944cf8740f934549#?env%5BIrene%20-%20Local%5D=W3sia2V5IjoiYmFzZV91cmwiLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWV9LHsia2V5IjoiZGlhbG9nZmxvd190b2tlbiIsInZhbHVlIjoiIiwiZW5hYmxlZCI6dHJ1ZX0seyJrZXkiOiJwdXNoYnVsbGV0X3Rva2VuIiwidmFsdWUiOiIiLCJlbmFibGVkIjp0cnVlfSx7ImtleSI6InB1c2hidWxsZXRfYWNjZXNzX3Rva2VuIiwidmFsdWUiOiIiLCJlbmFibGVkIjpmYWxzZX1d).

Feel free to give Irene a chat on Facebook [Messenger](https://www.facebook.com/irene.artificial.intelligence.assistant.lite)!
