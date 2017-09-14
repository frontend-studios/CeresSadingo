<?php

namespace CeresSadingo\Providers;


use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class TopItemsRouteServiceProvider extends RouteServiceProvider
{
    public function map(Router $router)
    {
        $router->get('', 'CeresSadingo\Controllers\ContentController@showTopItems');
    }
}
