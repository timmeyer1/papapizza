<?php

namespace App\Controller;

use App\App;
use App\Model\User;
use Core\View\View;
use App\AppRepoManager;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Controller\Controller;
use App\Controller\AuthController;
use Laminas\Diactoros\ServerRequest;

class UserController extends Controller
{

    // PING: page du compte
    public function account(int $id)
    {
        $view = new View('user/account');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),
            'form_result' => Session::get(Session::FORM_RESULT)


        ];

        $view->render($view_data);
    }

    // PING: page du panier
    public function basket()
    {
        if (!AuthController::isAuth()) self::redirect('/connexion');
        $view = new View('user/basket');
        $view_data = [
            'user' => Session::get('USER'),
            'pizzas' => AppRepoManager::getRm()->getPizzaRepository()->getAllPizzas()

        ];

        $view->render($view_data);
    }

    public function basketForm(ServerRequest $request)
    {

        $data_form = $request->getParsedBody();
        $form_result = new FormResult();

        $data_basket = [
            'user_id' => Session::get('USER')->id,
            'pizza_id' => $data_form['pizza_id'],
            
        ]
    }


    // PING: page d'affichage des créations des pizzas
    public function yourPizzas(int $id)
    {
        $view = new View('user/your-pizzas');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),
            'pizzas' => AppRepoManager::getRm()->getPizzaRepository()->getPizzaByUserId($user_id = $id)

        ];

        $view->render($view_data);
    }

    // PING: modification des données personelles
    // NOTE NOM
    public function editLastname(int $id)
    {
        $view = new View('user/edit-lastname');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),

        ];

        $view->render($view_data);
    }
    // NOTE PRENOM
    public function editFirstname(int $id)
    {
        $view = new View('user/edit-firstname');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),

        ];

        $view->render($view_data);
    }
    // NOTE PHONE
    public function editPhone(int $id)
    {
        $view = new View('user/edit-phone');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),

        ];

        $view->render($view_data);
    }
    // NOTE ADDRESS
    public function editAddress(int $id)
    {
        $view = new View('user/edit-address');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),

        ];

        $view->render($view_data);
    }

    // UP NOM formulaire de changement NOM
    public function editLastnameForm(ServerRequest $request): array
    {
        //on vérifie que l'utilisateur est connecté et est admin
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();
        $user = new User();


        // si le champ est rempli:
        if (
            empty($data_form['lastname'])
        ) {
            $form_result->addError(new FormError('Veuillez renseigner ce champ'));
        } else {
            $data_user = [
                'lastname' => trim($data_form['lastname']),
                'id' => Session::get('USER')->id
            ];

            $user = AppRepoManager::getRm()->getUserRepository()->editLastname($data_user);
        }

        // on redirige
        self::redirect('/account/' . Session::get('USER')->id);
    }
    // UP NOM formulaire de changement PRENOM
    public function editFirstnameForm(ServerRequest $request): array
    {
        //on vérifie que l'utilisateur est connecté et est admin
        $data_form = $request->getParsedBody();
        // var_dump($data_form);
        // die;
        $form_result = new FormResult();
        $user = new User();


        // si le champ est rempli:
        if (
            empty($data_form['firstname'])
        ) {
            $form_result->addError(new FormError('Veuillez renseigner ce champ'));
        } else {
            $data_user = [
                'firstname' => trim($data_form['firstname']),
                'id' => Session::get('USER')->id
            ];

            $user = AppRepoManager::getRm()->getUserRepository()->editFirstname($data_user);
        }

        // on redirige
        self::redirect('/account/' . Session::get('USER')->id);
    }
    // UP NOM formulaire de changement PHONE
    public function editPhoneForm(ServerRequest $request): array
    {
        //on vérifie que l'utilisateur est connecté et est admin
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();
        $user = new User();


        // si le champ est rempli:
        if (
            empty($data_form['phone'])
        ) {
            $form_result->addError(new FormError('Veuillez renseigner ce champ'));
        } else {
            $data_user = [
                'phone' => trim($data_form['phone']),
                'id' => Session::get('USER')->id
            ];

            $user = AppRepoManager::getRm()->getUserRepository()->editPhone($data_user);
        }

        // on redirige
        self::redirect('/account/' . Session::get('USER')->id);
    }
    // UP NOM formulaire de changement ADDRESS
    public function editAddressForm(ServerRequest $request): array
    {
        //on vérifie que l'utilisateur est connecté et est admin
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();
        $user = new User();


        // si le champ est rempli:
        if (
            empty($data_form['address'])
        ) {
            $form_result->addError(new FormError('Veuillez renseigner ce champ'));
        } else {
            $data_user = [
                'address' => trim($data_form['address']),
                'id' => Session::get('USER')->id
            ];

            $user = AppRepoManager::getRm()->getUserRepository()->editAddress($data_user);
        }

        // on redirige
        self::redirect('/account/' . Session::get('USER')->id);
    }

    // PING: création d'une pizza personnalisée par l'utilisateur

    public function createPizza(int $id)
    {

        $view = new View('user/create-pizza');
        $view_data = [
            'user' => AppRepoManager::getRm()->getUserRepository()->findUserById($id),
            'form_result' => Session::get(Session::FORM_RESULT)
        ];

        $view->render($view_data);
    }

    public function createPizzaForm(ServerRequest $request)
    {
        $post_data = $request->getParsedBody();
        $file_data = $_FILES['image_path'];
        $form_result = new FormResult();

        // ... (code existant)

        $array_ingredients = $post_data['ingredients'];

        // Vérifier si le nombre d'ingrédients dépasse 6
        if (count($array_ingredients) > 6) {
            $form_result->addError(new FormError('Vous ne pouvez pas choisir plus de 6 ingrédients pour votre pizza'));
        } else {
            // Continuer avec le reste du code si le nombre d'ingrédients est acceptable
            $name = $post_data['name'];
            $user_id = $post_data['user_id'];
            $image_name = $file_data['name'];
            $tmp_path = $file_data['tmp_name'];
            $public_path = 'public/assets/images/pizza/';
            $form_result = new FormResult();

            if (
                empty($name) ||
                empty($user_id) ||
                empty($array_ingredients)
            ) {
                $form_result->addError(new FormError('Veuillez remplir tous les champs'));
            } else {
                $filename = uniqid() . '_' . $image_name;
                $slug = explode('.', strtolower(str_replace(' ', '-', $filename)))[0];
                $imgPathPublic = PATH_ROOT . $public_path . $filename;

                $data_pizza = [
                    'name' => htmlspecialchars(trim($name)),
                    'image_path' => htmlspecialchars(trim($filename)),
                    'user_id' => intval($user_id),
                    'is_active' => 1,
                ];

                if (move_uploaded_file($tmp_path, $imgPathPublic)) {
                    $pizza = AppRepoManager::getRm()->getPizzaRepository()->insertPizza($data_pizza);

                    if (!$pizza) {
                        $form_result->addError(new FormError('Erreur lors de l\'insertion de la pizza'));
                    } else {
                        $pizza_id = $pizza->id;

                        foreach ($array_ingredients as $ingredient_id) {
                            $data_pizza_ingredient = [
                                'pizza_id' => intval($pizza_id),
                                'ingredient_id' => intval($ingredient_id),
                                'quantity' => 1,
                                'unit_id' => 5
                            ];
                            $pizza_ingredient = AppRepoManager::getRm()->getPizzaIngredientRepository()->insertPizzaIngredient($data_pizza_ingredient);

                            if (!$pizza_ingredient) {
                                $form_result->addError(new FormError('Erreur lors de l\'insertion des ingrédients de la pizza'));
                            }
                        }
                    }
                } else {
                    $form_result->addError(new FormError('Erreur lors de l\'upload de l\'image'));
                }
            }
        }

        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/pizza/create/' . Session::get('USER')->id);
        }

        Session::remove(Session::FORM_RESULT);
        self::redirect('/account/your-pizzas/' . Session::get('USER')->id);
    }
}
