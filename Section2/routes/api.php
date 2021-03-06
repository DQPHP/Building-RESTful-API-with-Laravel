<?php

use Dingo\Api\Routing\Router;

/** @var Dingo\Api\Routing\Router $router */
$router = app(Router::class);

$router->version('v1', function (Router $router) {
    $router->group(['namespace' => 'App\Http\Controllers'], function ($router) {
        // System status
        $router->group(['prefix' => 'status'], function (Router $router) {
            $router->get('ping', 'ServerController@ping');
            $router->get('version', 'ServerController@version');
        });

        $router->group(['prefix' => 'weather'], function (Router $router) {
            $router->get('city/{city}/current', 'QueryController@current');
            $router->get('city/{city}/all', 'QueryController@all');
            $router->get('city/{city}/date/{date}', 'QueryController@date')
                // http://html5pattern.com/Dates
                ->where('date', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])');
        });
    });
});