PORT?=8080
IMG_NAME?= jva/php-apache

.PHONY: start
start:
	docker build --file .docker/Dockerfile -t $(IMG_NAME) .
	docker run --name apache -d -p $(PORT):80 $(IMG_NAME)

.PHONY: build
build:
	docker build --file .docker/Dockerfile -t $(IMG_NAME) .

.PHONY: dev
dev:
	docker run \
	--name apache \
	-d \
	-p $(PORT):80 \
	-v $(PWD)/src:/var/www/html \
	$(IMG_NAME)

.PHONY: devwin
devwin:
	docker build --file .docker/Dockerfile -t $(IMG_NAME) .
	# docker run --name apache -d -p $(PORT):80 --mount type=bind,source="$(CURDIR)"/../htdocs,target=/var/www/html $(IMG_NAME)
	docker run --name apache -d -p $(PORT):80 -v /home/docker/projects/boozt/sales:/srv/app $(IMG_NAME)

.PHONY: stop
stop:
	docker stop apache

.PHONY: remove
remove:
	docker rm apache

.PHONY: wipe
wipe:
	docker stop apache
	docker rm apache


.PHONY: exec
exec:
	docker exec -it apache bash

.PHONY: logs
logs:
	docker container logs apache

.PHONY: login
login:
	docker exec -it apache bash

.PHONY: status
status:
	docker ps -f name=apache
