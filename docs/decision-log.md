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

### We won't do I18n, we use English only

### Error and exception handling

Check for potetial error situations and use `die` to stop execution and report reason.
Should we raise and exception instead of using `die` ??
TODO: Handle errors better: gracefully

### Testing???

### Logging

### Code formatting (VS Code ext.)??????

## Technicalities

- Indentation: two-spaces

[ard-nygard]: https://www.thoughtworks.com/radar/techniques/lightweight-architecture-decision-records
