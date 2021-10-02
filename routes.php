<?php

declare(strict_types=1);

$router->get("/colleges", "College\Colleges\CollegesController::getAll");
$router->post("/colleges", "College\Colleges\CollegesController::insert");
$router->group("/colleges", function ($router) {
    $router->get("/{college_id:number}", "College\Colleges\CollegesController::get");
    $router->post("/{college_id:number}", "College\Colleges\CollegesController::update");
    $router->delete("/{college_id:number}", "College\Colleges\CollegesController::delete");
});

$router->get("/buildings", "College\Buildings\BuildingsController::getAll");
$router->post("/buildings", "College\Buildings\BuildingsController::insert");
$router->group("/buildings", function ($router) {
    $router->get("/{building_id:number}", "College\Buildings\BuildingsController::get");
    $router->post("/{building_id:number}", "College\Buildings\BuildingsController::update");
    $router->delete("/{building_id:number}", "College\Buildings\BuildingsController::delete");
});

$router->get("/classrooms", "College\Classrooms\ClassroomsController::getAll");
$router->post("/classrooms", "College\Classrooms\ClassroomsController::insert");
$router->group("/classrooms", function ($router) {
    $router->get("/{classroom_id:number}", "College\Classrooms\ClassroomsController::get");
    $router->post("/{classroom_id:number}", "College\Classrooms\ClassroomsController::update");
    $router->delete("/{classroom_id:number}", "College\Classrooms\ClassroomsController::delete");
});

$router->get("/textbooks", "College\Textbooks\TextbooksController::getAll");
$router->post("/textbooks", "College\Textbooks\TextbooksController::insert");
$router->group("/textbooks", function ($router) {
    $router->get("/{textbook_id:number}", "College\Textbooks\TextbooksController::get");
    $router->post("/{textbook_id:number}", "College\Textbooks\TextbooksController::update");
    $router->delete("/{textbook_id:number}", "College\Textbooks\TextbooksController::delete");
});

$router->get("/courses", "College\Courses\CoursesController::getAll");
$router->post("/courses", "College\Courses\CoursesController::insert");
$router->group("/courses", function ($router) {
    $router->get("/{course_id:number}", "College\Courses\CoursesController::get");
    $router->post("/{course_id:number}", "College\Courses\CoursesController::update");
    $router->delete("/{course_id:number}", "College\Courses\CoursesController::delete");
});

$router->get("/persons", "College\Persons\PersonsController::getAll");
$router->post("/persons", "College\Persons\PersonsController::insert");
$router->group("/persons", function ($router) {
    $router->get("/{person_id:number}", "College\Persons\PersonsController::get");
    $router->post("/{person_id:number}", "College\Persons\PersonsController::update");
    $router->delete("/{person_id:number}", "College\Persons\PersonsController::delete");
});

$router->get("/faculties", "College\Faculties\FacultiesController::getAll");
$router->post("/faculties", "College\Faculties\FacultiesController::insert");
$router->group("/faculties", function ($router) {
    $router->get("/{faculty_id:number}", "College\Faculties\FacultiesController::get");
    $router->post("/{faculty_id:number}", "College\Faculties\FacultiesController::update");
    $router->delete("/{faculty_id:number}", "College\Faculties\FacultiesController::delete");
});

$router->get("/interns", "College\Interns\InternsController::getAll");
$router->post("/interns", "College\Interns\InternsController::insert");
$router->group("/interns", function ($router) {
    $router->get("/{intern_id:number}", "College\Interns\InternsController::get");
    $router->post("/{intern_id:number}", "College\Interns\InternsController::update");
    $router->delete("/{intern_id:number}", "College\Interns\InternsController::delete");
});

$router->get("/sections", "College\Sections\SectionsController::getAll");
$router->post("/sections", "College\Sections\SectionsController::insert");
$router->group("/sections", function ($router) {
    $router->get("/{section_id:number}", "College\Sections\SectionsController::get");
    $router->post("/{section_id:number}", "College\Sections\SectionsController::update");
    $router->delete("/{section_id:number}", "College\Sections\SectionsController::delete");
});

$router->get("/students", "College\Students\StudentsController::getAll");
$router->post("/students", "College\Students\StudentsController::insert");
$router->group("/students", function ($router) {
    $router->get("/{student_id:number}", "College\Students\StudentsController::get");
    $router->post("/{student_id:number}", "College\Students\StudentsController::update");
    $router->delete("/{student_id:number}", "College\Students\StudentsController::delete");
});

