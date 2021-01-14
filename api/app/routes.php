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

    $app->get('/', function (Request $request, Response $response){
         $response->getBody()->write("<form action='/animals/1' method='DELETE'><input type='text' value='Billy' name='name'><input type='text' name='type' value='cat'> <input type='submit' value='test'> </form> ");
         return $response;
    });

    $app->group('/animals', function (Group $group) {
        $group->get('', ListAnimalsAction::class);
        $group->get('/{id}',GetAnimalAction::class);
        $group->post('', NewAnimalAction::class);
        $group->post('/{id}', UpdateAnimalAction::class);

    });
    

};
