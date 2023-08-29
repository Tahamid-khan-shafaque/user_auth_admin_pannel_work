<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {

        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        $builder->connect('/pages/*', 'Pages::display');

        $builder->connect('/register', ['controller' => 'Users', 'action' => 'register']);

        // Define the route for the login action
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        
        // Define the route for the view action
        $builder->connect('/view', ['controller' => 'Users', 'action' => 'view']);
        $builder->fallbacks();
    });


};
