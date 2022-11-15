<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Policy;
use Exception;
use Storage\FileService;
use Traits\Controllers\InsurerInsuranceActive;
use Traits\Controllers\policyControllerUserController;

class PolicyController extends Controller
{
    use InsurerInsuranceActive;
    use policyControllerUserController;

    public function index(): bool|array
    {
        return (new Policy()) -> index();
    }

    public function create(Policy $policy): void
    {
        try {
            $file_service = $policy -> upload();
            if (is_string($file_service)) {
                throw new Exception('No se pudo cargar el archivo. '.$file_service);
            }
            $new_policy = $policy -> create();
            if ($new_policy !== true) {
                throw new Exception($new_policy);
            }
            $file = (new File( $file_service['id'], $file_service['name'], new Policy($policy -> getCode()) )) -> create();
            if (is_string($file)) {
                throw new Exception($file);
            }
            $this -> response('Póliza creada');
        } catch (Exception $e) {
            echo json_encode($e -> getMessage());
        }
    }

    public function show(Policy $policy): void
    {
        echo json_encode($policy -> show());
    }

    public function view(string $view): void
    {
        $status = (new Policy()) -> state();
        require_once $view;
    }

    public function update(Policy $policy, Policy $policy_update, File $file_update): void
    {
        try {
            $update_policy = $policy -> update($policy_update -> getCode());
            if (is_string($update_policy)) {
                throw new Exception($update_policy);
            }
            if ($policy -> verifyFileService()) {
                $updated_file = $policy -> updateFile();
                if (is_string($updated_file)) {
                    throw new Exception('No se pudo actualizar el archivo de la póliza');
                }
                $file = (new File($file_update -> getId(),$updated_file['id'], $updated_file['name'])) -> update();
                if (is_string($file)) {
                    throw new Exception($file);
                }
            }
            $this -> response('Póliza actualizada');
        } catch (Exception $e) {
            echo json_encode($e -> getMessage());
        }
    }

    public function delete(Policy $policy): void
    {
        $policy -> delete();
        $this -> response('Póliza eliminada');
    }
}

