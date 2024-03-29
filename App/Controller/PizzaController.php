<?php 

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Session\Session;
use Core\Controller\Controller;

class PizzaController extends Controller
{
    public function home()
    {
        //on instancie la class View et on lui passe en paramètre le chemin de la vue
        // dossier/fichier
        $view = new View('home/index');

        //on appelle la méthode render() de la class View
        $view->render();
    }

    //méthode qui récupère la liste des pizzas
    public function getPizzas()
    {
        $view_data = [
            'pizzas' => AppRepoManager::getRm()->getPizzaRepository()->getAllPizzas(),
            'user' => Session::get('USER')
        ];

        $view = new View('home/pizzas');

        $view->render($view_data);
    }

    //méthode qui récupère une pizza par son id
    public function getPizzaById($id)
    {
        $view_data = [
            'pizza' => AppRepoManager::getRm()->getPizzaRepository()->getPizzaById($id),
        ];

        $view = new View('home/pizza_detail');

        $view->render($view_data);
    }
}