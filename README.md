Dog Walker
==========


Sample application in PHP with Symfony and working through hexagonal architecture implementing DDD


## Installation

´´´
# Clone project
$ git clone https://github.com/moriorgames/dog-walker.git
# move to folder project
$ cd dog-walker
# Install dependencies with composer
$ php phars/composer.phar install
# Copy .env file to .env.local
$ cp .env .env.local
# Create docker network
$ docker network create dev
# Run project with docker-compose
$ docker-compose up -d
´´´

## About Ngnix
``` 
# docker cp docker/etc/nginx/conf.d/default.conf dog_walker_nginx:/etc/nginx/conf.d/default.conf
# docker restart dog_walker_nginx
# docker logs -f dog_walker_nginx
```
