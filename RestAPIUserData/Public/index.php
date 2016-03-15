<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI;

include '../../RestAPI/App.php';

$router = new Router();

$router->map('GET', '/news/[:id]', function($id) {
    
});

$router->map('POST', '/news/:id', 'News#update');

$router->map('POST', '/news/', 'News#create');

//$router->map('DELETE', '/news/:id', [$news, 'delete']);

$router->map('GET', '/users/:userId/comments/[:id]', function($userId, $id) {
    
}); // this is just usage example

$result = $router->match();

var_dump($result);

App::getInstance();
