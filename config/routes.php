<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

function check_admin_rights() {
    BaseController::check_admin_rights();
}

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/login', function() {
    MarketinguruController::login();
});

$routes->post('/login', function() {
    MarketinguruController::handle_login();
});

$routes->post('/logout', function() {
    MarketinguruController::logout();
});


$routes->get('/customers', 'check_logged_in', function() {
    CustomerController::index();
});

$routes->post('/customers/new', 'check_logged_in', function() {
    CustomerController::store();
});

$routes->post('/customers/new', 'check_logged_in', function() {
    CustomerController::create();
});

$routes->get('/customers/new', 'check_logged_in', function() {
    CustomerController::create();
});

$routes->post('/customers/delete/:id', 'check_logged_in', function($id) {
    CustomerController::delete($id);   
});

$routes->get('/customers/:id', 'check_logged_in', function($id) {
    CustomerController::find($id);
});

$routes->post('/customers/modify/:id', 'check_logged_in', function($id) {
    CustomerController::update($id);
});

$routes->get('/customers/modify/:id', 'check_logged_in', function($id) {
    CustomerController::modify($id);
});

$routes->get('/customers/modify/:id', 'check_logged_in', function($id) {
    CustomerController::find($id);
});

$routes->get('/users', 'check_logged_in', 'check_admin_rights', function() {
    MarketinguruController::index();
});

$routes->post('/users/new', 'check_logged_in', 'check_admin_rights', function() {
    MarketinguruController::store();
});

$routes->get('/users/new', 'check_logged_in', 'check_admin_rights', function() {
    MarketinguruController::create();
});

$routes->get('/users/:id', 'check_logged_in', 'check_admin_rights', function($id) {
    MarketinguruController::find($id);
});

$routes->post('/users/modify/:id', 'check_logged_in', 'check_admin_rights', function($id) {
    MarketinguruController::update($id);
});

$routes->get('/users/modify/:id', 'check_logged_in', 'check_admin_rights', function($id) {
    MarketinguruController::modify($id);
});

$routes->post('/users/delete/:id', 'check_logged_in', 'check_admin_rights', function($id) {
    MarketinguruController::delete($id);
});

$routes->get('/queries', 'check_logged_in', function() {
    QueryController::index();
});

$routes->post('/queries/new', 'check_logged_in', function() {
    QueryController::store();
});

$routes->post('/queries/new', 'check_logged_in', function() {
    QueryController::create();
});

$routes->get('/queries/new', 'check_logged_in', function() {
    QueryController::create();
});

$routes->get('/queries/:id', 'check_logged_in', function($id) {
    QueryController::find($id);
});

$routes->get('/customers/:customerid/newsubs', 'check_logged_in', function($customerid) {
    SubsController::initialize($customerid);
});

$routes->post('/customers/:customerid/newsubs', 'check_logged_in', function() {
    SubsController::store();
});

$routes->get('/customers/:customerid/subs/:subsid', 'check_logged_in', function($customerid, $subsid) {
    SubsController::cancellation($customerid, $subsid);
});

$routes->post('/customers/:customerid/subs/:subsid', 'check_logged_in', function($customerid, $subsid) {
    SubsController::cancel($customerid, $subsid);
});