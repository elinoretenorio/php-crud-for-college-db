<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", College\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Colleges

$container->add("CollegesRepository", College\Colleges\CollegesRepository::class)
    ->addArgument("Database");
$container->add("CollegesService", College\Colleges\CollegesService::class)
    ->addArgument("CollegesRepository");
$container->add(College\Colleges\CollegesController::class)
    ->addArgument("CollegesService");

// Buildings

$container->add("BuildingsRepository", College\Buildings\BuildingsRepository::class)
    ->addArgument("Database");
$container->add("BuildingsService", College\Buildings\BuildingsService::class)
    ->addArgument("BuildingsRepository");
$container->add(College\Buildings\BuildingsController::class)
    ->addArgument("BuildingsService");

// Classrooms

$container->add("ClassroomsRepository", College\Classrooms\ClassroomsRepository::class)
    ->addArgument("Database");
$container->add("ClassroomsService", College\Classrooms\ClassroomsService::class)
    ->addArgument("ClassroomsRepository");
$container->add(College\Classrooms\ClassroomsController::class)
    ->addArgument("ClassroomsService");

// Textbooks

$container->add("TextbooksRepository", College\Textbooks\TextbooksRepository::class)
    ->addArgument("Database");
$container->add("TextbooksService", College\Textbooks\TextbooksService::class)
    ->addArgument("TextbooksRepository");
$container->add(College\Textbooks\TextbooksController::class)
    ->addArgument("TextbooksService");

// Courses

$container->add("CoursesRepository", College\Courses\CoursesRepository::class)
    ->addArgument("Database");
$container->add("CoursesService", College\Courses\CoursesService::class)
    ->addArgument("CoursesRepository");
$container->add(College\Courses\CoursesController::class)
    ->addArgument("CoursesService");

// Persons

$container->add("PersonsRepository", College\Persons\PersonsRepository::class)
    ->addArgument("Database");
$container->add("PersonsService", College\Persons\PersonsService::class)
    ->addArgument("PersonsRepository");
$container->add(College\Persons\PersonsController::class)
    ->addArgument("PersonsService");

// Faculties

$container->add("FacultiesRepository", College\Faculties\FacultiesRepository::class)
    ->addArgument("Database");
$container->add("FacultiesService", College\Faculties\FacultiesService::class)
    ->addArgument("FacultiesRepository");
$container->add(College\Faculties\FacultiesController::class)
    ->addArgument("FacultiesService");

// Interns

$container->add("InternsRepository", College\Interns\InternsRepository::class)
    ->addArgument("Database");
$container->add("InternsService", College\Interns\InternsService::class)
    ->addArgument("InternsRepository");
$container->add(College\Interns\InternsController::class)
    ->addArgument("InternsService");

// Sections

$container->add("SectionsRepository", College\Sections\SectionsRepository::class)
    ->addArgument("Database");
$container->add("SectionsService", College\Sections\SectionsService::class)
    ->addArgument("SectionsRepository");
$container->add(College\Sections\SectionsController::class)
    ->addArgument("SectionsService");

// Students

$container->add("StudentsRepository", College\Students\StudentsRepository::class)
    ->addArgument("Database");
$container->add("StudentsService", College\Students\StudentsService::class)
    ->addArgument("StudentsRepository");
$container->add(College\Students\StudentsController::class)
    ->addArgument("StudentsService");

