<?php

namespace App\Controllers;

use App\Models\User;
use Exception;
use Mail\Mail;
use Traits\Controllers\ClientControllerUserController;
use Traits\Controllers\InsuranceCard;
use Traits\Controllers\InsurerCard;
use Traits\Controllers\InsurerInsuranceActive;
use Traits\Controllers\policyControllerUserController;
use Traits\Controllers\quoteControllerUserController;

class UserController
{
    use InsurerInsuranceActive;
    use InsurerCard;
    use InsuranceCard;
    use ClientControllerUserController;
    use quoteControllerUserController;
    use policyControllerUserController;

    public function index(): bool|array
    {
        return (new User()) -> index();
    }

    public function create(User $user): void
    {
        try {
            if (is_string($user -> create())) {
                throw new Exception('No se pudo crear el usuario');
            }
            ob_start();
            require_once view('mail/email_confirmation.php');
            $body = ob_get_clean();
            if (is_string((new Mail($user -> getEmail(), $user -> getFirstName() . ' ' . $user -> getFirstSurname(), 'Verificar correo electrónico', $body)) -> send())) {
                $user -> delete();
                throw new Exception('No pudimos crear tu cuenta');
            }
            echo json_encode('Tu cuenta ha sido creada exitosamente');
        } catch (Exception $e) {
            echo json_encode($e -> getMessage());
        }
    }

    public function delete(User $user): void
    {
        $user -> inactivate();
    }

    public function view(string $view): void
    {
        $types_documents = (new User()) -> documentType();
        require_once $view;
    }

    public function dashboard(): void
    {
        $array = $this -> productsActive();
        $array['total_clients'] = $this -> totalClients();
        $array['total_quotes'] = $this -> totalQuotes();
        $array['total_policies'] = $this -> totalPolicies();
        $array['count_states_policies'] = $this -> countStates();
        echo json_encode($array);
    }

    public function products(): void
    {
        echo json_encode(['insurers' => $this -> insurerCard(), 'insurances' => $this -> insuranceCard()]);
    }

    public function login(User $user): void
    {
        try {
            $login = $user -> login();
            if ($login === false) {
                throw new Exception('Usuario y/o contraseña incorrectos');
            }
            echo json_encode($login);
        } catch (Exception $e) {
            echo json_encode($e -> getMessage());
        }
    }

    public function update(User $user, string $document): void
    {
        $user -> update($document);
        $this -> show($user);
    }

    public function show(User $user): void
    {
        echo json_encode($user -> show());
    }
}
