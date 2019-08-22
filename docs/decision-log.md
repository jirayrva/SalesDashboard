# Decision log

## Purpose

The purpose of this document is to track major architectural decisions made throughout the development.

The original idea is to have a full-fledged [Architectural Decision Record][ard-nygard], but due to the limited time and scope a single file is sufficient. The original template for decisions encludes {context, decision, status and consequences}. However, to keep it concise I'll assume all decision are accepted.

## Constraints

- We will use PHP
- We will use MVC
- We will NOT use a PHP framework
- We will use Bootstrap for layout
- UI???

## Decisions

### We'll use GIT, Doh

### We'll try to have verything as code

### We will use Docker for development

Docker is mainly used in operations. However, it can be easily used in development with some slight tweaks to improve developmdent experience.

- We'll use the official image
- We'll use the Apache variant
- We'll maintain the Dockerfile along with all configuration fiels in `.docker`. Only `docker-compose.yaml` will remain in the root folder

### We'll manage commands in GNU Make, even on Windows

### Compose??

### We will build a mini MVC framework

### Technicalities

- Indentation: two-spaces

[ard-nygard]: https://www.thoughtworks.com/radar/techniques/lightweight-architecture-decision-records
