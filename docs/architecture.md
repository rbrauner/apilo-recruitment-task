# Architecture

## Overview

Inpost module is responsible for receiving a list of parcels for given city. This action can be accessed using both CLI and REST API endpoint. Whole module is created using DDD approach.

## Technologies

-   PHP 8.3.8
-   Composer 2.7.7
-   PHPUnit
-   PHPStan
-   PHP-CS-Fixer
-   PHP CodeSniffer
-   Rector
-   GrumPHP

## Folder structure

-   src/Inpost/Application - contains application layer including CQRS query
-   src/Inpost/Domain - contains domain layer including models
-   src/Inpost/Infrastructure - contains infrastructure layer (for now empty)
-   src/Inpost/Presentation - contains presentation layer including CLI and REST API endpoint
-   tests/Inpost - contains tests for all layers
