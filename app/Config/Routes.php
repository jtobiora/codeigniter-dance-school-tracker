<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\MemberController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Membership
$routes->get('/members', 'MemberController::index');
$routes->get('/members/create', 'MemberController::create');
$routes->post('/members/store', 'MemberController::store');

$routes->get('/members/edit/(:num)', 'MemberController::edit/$1');
$routes->get('/members/delete/(:num)', 'MemberController::delete/$1');
$routes->post('/members/update/(:num)', 'MemberController::update/$1');
$routes->get('members/search', 'MemberController::search');

//Events
$routes->get('/events', 'EventController::index');
$routes->get('/events/create', 'EventController::create');
$routes->post('/events/store', 'EventController::store');
$routes->get('/events/edit/(:num)', 'EventController::edit/$1');
$routes->post('/events/update/(:num)', 'EventController::update/$1');
$routes->get('/events/delete/(:num)', 'EventController::delete/$1');

#Attendance
$routes->get('/attendance', 'AttendanceController::index');               // select event list
$routes->get('/attendance/(:num)', 'AttendanceController::index/$1');     // attendance for event
$routes->post('/attendance/save/(:num)', 'AttendanceController::saveAttendance/$1');

// Attendance listing (report)
$routes->get('/attendance/report', 'AttendanceController::report');

// Edit single attendance
$routes->get('/attendance/edit/(:num)', 'AttendanceController::edit/$1');
$routes->post('/attendance/update/(:num)', 'AttendanceController::update/$1');

// Delete single attendance
$routes->get('/attendance/delete/(:num)', 'AttendanceController::delete/$1');


//Report
$routes->group('attendance-report', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'ReportController::index');
    $routes->get('exportCsv', 'ReportController::exportCsv');
    $routes->post('sendEmails', 'ReportController::sendEmails');
});

