<?php
declare(strict_types=1);
                        
namespace App\Application\Actions\Animal;
                        
use Psr\Http\Message\ResponseInterface as Response;
                        
class GetAnimalAction extends AnimalAction
{
    protected function action(): Response
    {
        $animalId = (int) $this->resolveArg('id');
        $animal = $this->animal->find($animalId);
        return $this->respondWithData($animal);
    }
}