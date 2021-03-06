Dog Walker
==========


Sample application in PHP with Symfony and working through hexagonal architecture implementing DDD


## Installation

```
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
```

## About Ngnix
``` 
# docker cp docker/etc/nginx/conf.d/default.conf dog_walker_nginx:/etc/nginx/conf.d/default.conf
# docker restart dog_walker_nginx
# docker logs -f dog_walker_nginx
```

## About Makefile

Make is a build automation tool that allows us to create simple commands to complex tasks.
In this scenario, we use Makefile to integrate commands such as enter into the Docker Container, execute tests, or coverage. 

``` 
# Create docker container and enter the container
$ make shell
# Run tests
$ make test
# Run tests with coverage
$ make test-coverage
```