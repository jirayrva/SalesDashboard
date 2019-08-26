# Sales Dashboard

A quick challenge to implement a Sales Dashboard in PHP without any frameworks. The entire thing was time-boxed and done over a weekend.

You can read more about how this was develop in the [decision log](docs/decision-log.md) and [progress log](docs/progress.md)

## Requirements

- GNU Make
- Docker
- Docker-compose

## Installation

The fastest way to run the application is by using `Docker-compose`. But to make things easy there is a `Makefile` which contain tasks to speed up things. Once you run the app, dummy data will be loaded automatically for demo purposes

After installing Docker & Docker-compose execute the following:

```bash
# Build images and run all needed containers
make up
# shutdown the containers and remove then
make down
```

The only valid routes are

- `/Dashbaord/RangeData/yyyy-mm-dd/yyyy-mm-dd`: sales data `from/to`
- `/Dashbaord/RangeData/yyyy-mm-dd` : no `to` date, defaulting to today
- `/Dashbaord/RangeData` : no `from/to` dates, defaulting for the last x days (x is configurable but defaulting to 30 days)

P.S: All scripts are tested on Linux. In theory, they should run on other platforms but they are not tested.
