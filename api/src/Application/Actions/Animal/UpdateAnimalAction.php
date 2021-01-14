<?php
declare(strict_types=1);
                        
namespace App\Application\Actions\Animal;
                        
use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\Animal\Animal;
                        
class UpdateAnimalAction extends AnimalAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $animalId = (int) $this->resolveArg('id');

        //recherche les données à chercher selon id
        $animal = Animal::find($animalId);
        
        $animal->name = $data['name'];
        $animal->type = $data['type'];

        //enregistre les modifications
        $animal->save();

        return $this->respondWithData($animal);
    }
                            

}