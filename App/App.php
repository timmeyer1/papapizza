<?php

namespace App;

use MiladRahimi\PhpRouter\Router;
use App\Controller\AuthController;
use App\Controller\UserController;
use App\Controller\AdminController;
use App\Controller\PizzaController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;

class App implements DatabaseConfigInterface
{
    //on déclare des constantes pour la connexion à la base de données
    private const DB_HOST = 'database';
    private const DB_NAME = 'papapizza';
    private const DB_USER = 'admin';
    private const DB_PASS = 'admin';

    //on déclare une propriété privée qui va contenir une intance de app
    //Design pattern Singleton
    private static ?self $instance = null;

    //méthode public appelé au démarrage de l'application dans index.php
    public static function getApp():self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    //On va configurer notre router
    private Router $router;

    public function getRouter(): Router
    {
        return $this->router;
    }

    private function __construct()
    {
        $this->router = Router::create();
    }

    //on aura 3 méthodes à définir pour le router
    //1: méthode start() qui va démarrer le router dans l'application
    public function start(): void
    {
        //on ouvre l'accès à la session
        session_start();
        //on enregistre les routes
        $this->registerRoutes();
        //on démarre le router
        $this->startRouter();
    }

    //2: méthode qui enregistre les routes
    private function registerRoutes()
    {
        //exemple de routes avec un controller
        // $this->router->get('/', [ToyController::class, 'index']);
        $this->router->get('/', [PizzaController::class, 'home']);
        $this->router->get('/pizzas', [PizzaController::class, 'getPizzas']);
        $this->router->get('/pizzas/{id}', [PizzaController::class, 'getPizzaById']);
        // UP: route pour AFFICHER le FORMULAIRE de LOGIN
        $this->router->get('/connexion', [AuthController::class, 'loginForm']);
        // UP: route qui RECOIT le FORMULAIRE de LOGIN
        $this->router->post('/login', [AuthController::class, 'login']);
        // UP: route pour le FORMULAIRE d'INSCRIPTION
        $this->router->get('/inscription', [AuthController::class, 'registerForm']);
        // UP: route qui reçoit le formulaire de création de compte
        $this->router->post('/register', [AuthController::class, 'register']);
        // UP: route pour "SE DÉCONNECTER"
        $this->router->get('/logout', [AuthController::class, 'logout']);



        // IMPORTANT: PARTIE UTILISATEUR
        // NOTE: COULEUR JAUNE
        // route pour ACCEDER au COMPTE de l'UTILISATEUR
        $this->router->get('/account/{id}', [UserController::class, 'account']);
        // route pour ACCEDER à VOS PIZZAS
        $this->router->get('/account/your-pizzas/{id}', [UserController::class, 'yourPizzas']);

        // route pour AJOUTER au PANIER de l'UTILISATEUR
        $this->router->get('/account/basket/add', [UserController::class, 'basketAdd']);
        // route pour ACCEDER au PANIER de l'UTILISATEUR
        
        $this->router->get('/account/basket/{id}', [UserController::class, 'basket']);
        $this->router->post('/account/basket/form', [UserController::class, 'basketForm']);
    


        //NOTE: MODIFICATION INFO PERSONNELLE
        //NOTE: // route pour MODIFIER le NOM
        $this->router->get('/account/lastname/{id}', [UserController::class, 'editLastname']);
        $this->router->post('/account/edit-lastname/{id}', [UserController::class, 'editLastnameForm']);

        //NOTE: // route pour MODIFIER le PRENOM
        $this->router->get('/account/firstname/{id}', [UserController::class, 'editFirstname']);
        $this->router->post('/account/edit-firstname/{id}', [UserController::class, 'editFirstnameForm']);

        // NOTE: // route pour MODIFIER le PHONE
        $this->router->get('/account/phone/{id}', [UserController::class, 'editPhone']);
        $this->router->post('/account/edit-phone/{id}', [UserController::class, 'editPhoneForm']);

        // NOTE: // route pour MODIFIER l'ADRESSE
        $this->router->get('/account/address/{id}', [UserController::class, 'editAddress']);
        $this->router->post('/account/edit-address/{id}', [UserController::class, 'editAddressForm']);


        //NOTE: Création d'une pizza personnalisée
        $this->router->get('/pizza/create/{id}', [UserController::class, 'createPizza']);
        $this->router->post('/pizza/create/form/{id}', [UserController::class, 'createPizzaForm']);





        // IMPORTANT: PARTIE BACK OFFICE (ADMIN)
        // route pour acceder a la PAGE D'ADMINISTRATION
        $this->router->get('/admin/home', [AdminController::class, 'home']);
        $this->router->get('/admin/user/list', [AdminController::class, 'listUser']);
        $this->router->get('/admin/team/list', [AdminController::class, 'listTeam']);
        $this->router->get('/admin/pizza/list', [AdminController::class, 'listPizza']);
        $this->router->get('/admin/order/list', [AdminController::class, 'listOrder']);

        // route pour "SUPPRIMER" un UTILISATEUR
        $this->router->get('/admin/user/delete/{id}', [AdminController::class, 'deleteUser']);
        // route pour AJOUTER un MEMBRE d'équipe
        $this->router->get('/admin/team/add', [AdminController::class, 'addTeam']);
        // Uroute qui recevra le formulaire d'ajout d'un membre d'équipe
        $this->router->post('/register-team', [AuthController::class, 'registerTeam']);

        // route pour le FORMULAIRE qui AJOUTE une PIZZA
        $this->router->get('/admin/pizza/add', [AdminController::class, 'addPizza']);
        // route qui réceptionne le formulaire d'ajout de pizza
        $this->router->post('/add-pizza-form', [AdminController::class, 'addPizzaForm']);
        // route qui va "SUPPRIMER" une PIZZA
        $this->router->get('/admin/pizza/delete/{id}', [AdminController::class, 'deletePizza']);




        //NOTE: route menu édition pizza
        $this->router->get('/admin/pizza/edit/{id}', [AdminController::class, 'editPizza']);

        // UP: // route pour EDITER le NOM
        $this->router->get('/admin/pizza/edit/name/{id}', [AdminController::class, 'editName']);
        $this->router->post('/admin/pizza/edit/name/form/{id}', [AdminController::class, 'editNameForm']);
        // UP: // route pour EDITER l'IMAGE
        $this->router->get('/admin/pizza/edit/image/{id}', [AdminController::class, 'editImage']);
        $this->router->post('/admin/pizza/edit/image/form/{id}', [AdminController::class, 'editImageForm']);
        // UP: // route pour EDITER les INGREDIENTS
        $this->router->get('/admin/pizza/edit/ingredient/{id}', [AdminController::class, 'editingredient']);
        $this->router->post('/admin/pizza/edit/ingredient/form/{id}', [AdminController::class, 'editingredientForm']);
        // UP: // route pour EDITER le PRIX
        $this->router->get('/admin/pizza/edit/price/{id}', [AdminController::class, 'editprice']);
        $this->router->post('/admin/pizza/edit/price/form/{id}', [AdminController::class, 'editpriceForm']);
    
        

    }

    //3: méthode qui va démarrer le router
    private function startRouter()
    {
        try {
            $this->router->dispatch();
        } catch (RouteNotFoundException $e) {
            //TODO : gérer la vue 404
            var_dump('Erreur 404: ' . $e);
        } catch (InvalidCallableException $e) {
            //TODO : gérer la vue 500
            var_dump('Erreur 500: ' . $e);
        }
    }

    //on déclare nos méthodes imposé par l'interface DatabaseConfigInterface
    public function getHost(): string
    {
        return self::DB_HOST;
    }

    public function getName(): string
    {
        return self::DB_NAME;
    }

    public function getUser(): string
    {
        return self::DB_USER;
    }

    public function getPass(): string
    {
        return self::DB_PASS;
    }
}