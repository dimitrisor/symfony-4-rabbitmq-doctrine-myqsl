# symfony-4-rabbitmq-doctrine-mysql
A Symfony 4 based microservice that illustrates a use case in which a service, retrieves resources from a remote provider (REST api), adds them in a RabbitMQ queue, consumes the queue, and finally stores the dequeued messages in a remote database using Doctrine ORM.
# Table of Contents
***
1. [Technologies](#markdown-header-technologies)
2. [Installation](#markdown-header-installation)
3. [Future work](#markdown-header-future-work)
4. [Time taken](#markdown-header-time-taken)
***
# Technologies
### List of technologies used within the project:
- Symfony (version 4.4.3)
- PHP (version 7.4.14)
- MySQL (version 5.5.61)
- RabbitMQ (version N/A)
- Doctrine (version 2.7.1)
- List of additional Symfony Components installed:
    - symfony/http-client
    - symfony/serializer
    - symfony/property-info
    - symfony/property-access
    - php-amqplib/rabbitmq-bundle
    - symfony/orm-pack
    - symfony/serializer-pack
    - annotations
    - doctrine/doctrine-migrations-bundle
    - doctrine/orm
***
# Installation
### In order for the application to Run, the following steps must be performed:
1. Install PHP version >= 7.4.14
2. Install composer
3. `$git clone https://dimitrisor@bitbucket.org/dimitrisor/net2grid_php_assignment.git .`
4. Fill in the following environment variables in your ".env" environment file:
    - DATABASE_URL
    - RABBITMQ_URL
    - RABBITMQ_QUEUE_EXCHANGE_NAME
    - RABBITMQ_QUEUE_NAME
    - RESULT_PROVIDER_URL
5. `$composer update`
6. `$php bin/console doctrine:migrations:migrate`
7. `$symfony server:start`
8. `$php bin/console rabbitmq:consumer messaging`
***
# Future work
### TODO things, that are missing from the current deliverable:
- Write unit and integration tests
- Add PHPDoc blocks for classes, methods, and functions
- Dockerize Symfony application, automating processes
***
##### * Time taken
The implementation took approximately 3,5 full days of development including:
- 2 days for Learn the framework from 0 (how things work, research documentation, experiments)
- 1,5 days for Implementation