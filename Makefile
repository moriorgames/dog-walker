VERSION = $(shell git describe --tags --always --dirty)
BRANCH = $(shell git rev-parse --abbrev-ref HEAD)

.PHONY: help shell

all: help

help:
	@echo
	@echo "VERSION: $(VERSION)"
	@echo "BRANCH: $(BRANCH)"
	@echo
	@echo "usage: make <command>"
	@echo
	@echo "commands:"
	@echo "    shell     - create docker container and enter the container"
	@echo

shell: .env.local
	@docker-compose up -d dog-walker-php
	@docker-compose exec dog-walker-php bash
