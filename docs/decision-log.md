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

### Composer??

I'm not sure if I can use Composer. To be on the safe side, I'll write a PSR-4 loader

### We will build a mini MVC framework

- We will use clean URLs
- For the sake of simplicity we will have a static URL format with flat heirarchy.
  i.e: `/controller/action/[params[/....]`
- There are two alternatives
  1. Each controller will be in a file and actions are functions. `Home -> Controller/Home.php`
  1. Each controller will be in a folder and a specific file will host the actions `Home -> Controller/Home/Home.php`.
- The second approach allows for having utility/helper files along side the controller but it produces more files which is not needed for the scope of this project.
- For the record, I believe it is better to have componont based file-heirarchy (link to Brown's page) where each of the MVC file for a component reside next to each other. This becomes even more evident when using PSR04, not only the folder is not the same but also the namespaces. This is way beyond the scope of this challenge.
- Models are not bound statically, each controller use whatever models
- Each action has it's own, all views of a controller reside in one folder named the same as the controller

### We won't do I18n, we use English only

### Stateless vs Stateful?????

### We'll fetch data from DB and process them in the model

Even though creating optimized SQL statements help efficiency, but I don't prefer to hide the code in the DB. If performance becomes an issue, then we might consider that. Till then, fetch the tables and process in the model. For the sake of demonstration I'll create a function that does the processing in SQL.

### We will use composition. The model won't extend DB

### No templating system, nor Header, Footer system

### no bundling, linting, minification

### Logging

### Code formatting (VS Code ext.)??????

## Technicalities

- Indentation: two-spaces

[ard-nygard]: https://www.thoughtworks.com/radar/techniques/lightweight-architecture-decision-records
