PORT?=8082
IMG_NAME?= jva/php-apache

.PHONY: start
start:
	docker build --file .docker/Dockerfile -t $(IMG_NAME) .
	docker run --name apache -d -p $(PORT):80 $(IMG_NAME)

dev:
	docker build --file .docker/Dockerfile -t $(IMG_NAME) .
	# docker run --name apache -d -p $(PORT):80 --mount type=bind,source="$(CURDIR)"/../htdocs,target=/var/www/html $(IMG_NAME)
	docker run --name apache -d -p $(PORT):80 -v /home/docker/projects/boozt/sales:/srv/app $(IMG_NAME)

.PHONY: stop
stop:
	docker stop apache
	docker rm apache

.PHONY: logs
logs:
	docker container logs apache

.PHONY: login
login:
	docker exec -it apache bash

.PHONY: status
status:
	docker ps -f name=apache
