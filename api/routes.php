<?php

require_once './controllers/SearchController.php';

use Pecee\SimpleRouter\SimpleRouter as Router;
Router::setDefaultNamespace('controllers');


// search
Router::get('/zadanie6/api/search/date/{date}', 'SearchController@searchByDate');
Router::get('/zadanie6/api/search/name/{name}/state/{state}', 'SearchController@searchByNameAndState')->where([ 'name' => '[A-Za-z0-9%]+' ]);
Router::get('/zadanie6/api/search/holidays/{state}', 'SearchController@holidaysByState');
Router::get('/zadanie6/api/search/memorials', 'SearchController@findSlovakMemorialDays');


// insert name for day
Router::post('/zadanie6/api/add/', 'SearchController@insertNameForDay');
