<?php

require_once './controllers/SearchController.php';

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Handlers\IExceptionHandler;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

Router::setDefaultNamespace('controllers');


// search
Router::get('/zadanie6/api/search/date/{date}', 'SearchController@searchByDate')->where([ 'date' => '[0-9]+' ]);;
Router::get('/zadanie6/api/search/name/{name}/state/{state}', 'SearchController@searchByNameAndState')->where([ 'name' => '[A-Za-z0-9%]+' ]);
Router::get('/zadanie6/api/search/holidays/{state}', 'SearchController@holidaysByState')->where([ 'state' => '[A-Za-z]+' ]);
Router::get('/zadanie6/api/search/memorials', 'SearchController@findSlovakMemorialDays');


// insert name for day
Router::post('/zadanie6/api/add/', 'SearchController@insertNameForDay');


// handle 404 route
Router::get('/zadanie6/api/not-found', function(){
    return "404:  Not found";
});

Router::error(function(Request $request, \Exception $exception) {
    if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        response()->redirect('/zadanie6/api/not-found');
    }
});