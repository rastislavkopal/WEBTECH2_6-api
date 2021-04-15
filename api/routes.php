<?php

require_once './controllers/SearchController.php';

use Pecee\SimpleRouter\SimpleRouter as Router;
Router::setDefaultNamespace('controllers');


Router::get('/zadanie6/api/', function(){
    hello;
});

// search
Router::get('/zadanie6/api/search/date/{date}', 'SearchController@searchByDate');
Router::get('/zadanie6/api/search/name/{name}/state/{state}', 'SearchController@searchByNameAndState');

// find holidays by state
Router::get('/zadanie6/api/search/holidays/{state}', 'SearchController@holidaysByState');
// find mem
Router::get('/zadanie6/api/search/memorials/{state}', 'SearchController@findSlovakMemorialDays');


// insert name for day
Router::post('/zadanie6/api/add/', 'SearchController@insertNameForDay');
