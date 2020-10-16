<?php

require_once './libs/mvc/Controller.class.php';
require_once './libs/functions/redirect.function.php';

class UsuarioController extends Controller {

    public function __construct() {
        require_once('./mvc/models/Usuario.model.php');
        parent::__construct('usuario', new UsuarioModel);
    }

    /** Página de login */
    public function showLogin($errors = []) {
        if (Auth::isLoggedIn()) redirect(ADMIN);
        
        $this->view->render('page_login', [
            'errors' => $errors 
        ]);
    }
    /** Acción de login */
    public function login() {
        if (Auth::isLoggedIn()) redirect(ADMIN);

        $input = filter_input_array(INPUT_POST, [
            'user' => FILTER_SANITIZE_STRING,
            'password' => FILTER_DEFAULT
        ]);
        $errors = parent::checkRequiredInputs($input, [ 'user' ]);
        if (empty($errors)) {
            $user = $this->model->getElement([
                'where' => [
                    [ 'username', '=', $input[ 'user' ] ],
                    [ 'email', '=', $input[ 'user' ] ],
                    'strict' => false
                ]
            ]);
            if ($user) {
                if (password_verify($input[ 'password' ], $user[ 'password' ])) 
                   Auth::login($user);
                else $errors[] = 'Contraseña incorrecta';
            }
            else $errors[] = 'El usuario no existe';
        }
        $this->showLogin($errors);
    }

    public function logout() {
        Auth::logout();
    }

    protected function postRedirect(int $id): void {
        redirect(ADMIN . '/' . $this->table); // pq no hay pagina de usuario
    }
    protected function deleteRedirect(int $id): void {
        if (Auth::getUserId() == $id) Auth::logout(); // por si se eliminó a el mismo
        else parent::deleteRedirect($id);
    }

    /** Como password_verify no es una columna de la tabla, 
     *  no la agrego en la definición del modelo y la capturo acá */
    protected function filterInput(int $inputType, array $params): array {
        $input = parent::filterInput(INPUT_POST, $params);
        return array_merge($input, filter_input_array(INPUT_POST, [
            'password_verify' => FILTER_DEFAULT
        ]));
    }

    /** Controles extra para los datos del usuario */
    protected function checkRequiredInputs(array &$input, array $requiredFields): array {
        $errors = parent::checkRequiredInputs($input, $requiredFields);
        if (empty($errors)) {
            // control Username
            // if (strlen($input[ 'username' ]) < 4 || strlen($input[ 'username' ]) > 16) {
            if (strlen($input[ 'username' ]) > 16) {
                $errors[] = 'Username no puede tener más de 16 caracteres';
                return $errors;
            }
            $invalidChars = preg_replace("/[A-Za-z0-9-_]/", '', $input[ 'username' ]);
            if (!empty($invalidChars)) {
                $errors[] = 'Username no válido. Sólo se aceptan letras, dígitos, -, _.';
                return $errors;
            }
            // control password
            if (strlen($input[ 'password' ]) < 8) {
                $errors[] = 'La contraseña tiene que tener al menos 8 caracteres';
                return $errors;
            }
            if ($input[ 'password' ] !== $input[ 'password_verify' ]) {
                $errors[] = 'Las contraseñas no coinciden';
                return $errors;
            }
            else {
                unset($input[ 'password_verify' ]);
                $input[ 'password' ] = password_hash($input[ 'password' ], PASSWORD_DEFAULT);
            }
        }
        return $errors;
    }
}
