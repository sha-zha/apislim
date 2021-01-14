<?php
declare(strict_types=1);


use App\Application\Actions\Animal\ListAnimalsAction;
use App\Application\Actions\Animal\GetAnimalAction;
use App\Application\Actions\Animal\NewAnimalAction;
use App\Application\Actions\Animal\UpdateAnimalAction;
use App\Application\Actions\Animal\DeleteAnimalAction;// fin controllers

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });


    $app->group('/animals', function (Group $group) {
        $group->get('', ListAnimalsAction::class);
        $group->get('/{id}',GetAnimalAction::class);
        $group->post('', NewAnimalAction::class);
        $group->post('/update/{id}', UpdateAnimalAction::class);
        $group->post('/delete/{id}', DeleteAnimalAction::class);
    });
    

};
