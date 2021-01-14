<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Animal\ListAnimalsAction;
use App\Application\Actions\Animal\GetAnimalAction;
use App\Application\Actions\Animal\NewAnimalAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        $response->getBody()->write('<form method="POST" action="/animals"><input type="text" name="name"><input type="text" name="type"><input type="submit" value="test"></form>');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/animals', function (Group $group) {
        $group->get('', ListAnimalsAction::class);
        $group->get('/{id}',GetAnimalAction::class);
        $group->post('', NewAnimalAction::class);
    });
};
