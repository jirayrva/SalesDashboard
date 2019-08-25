PORT?=8080
IMG_NAME?= jva/php-apache
CONTAINER_NAME?= php-apache

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

.PHONY: db-backup
db-backup:
	# docker exec $(CONTAINER_NAME) /usr/bin/mysqldump -u root --password=rpwd mycompany > .docker/db.sql
	docker exec 4d35a5383fb2 /usr/bin/mysqldump -u root --password=rpwd mycompany > .docker/db.sql

.PHONY: dbr
dbr:
	cat .docker/db.sql | docker exec -i 4d35a5383fb2 /usr/bin/mysql -u root --password=rpwd mycompany

.PHONY: rebuild
rebuild:
	docker-compose down 
	make build
	docker-compose up -d
