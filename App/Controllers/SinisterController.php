<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\Sinister;
use Exception;
use Traits\Controllers\TransformData;
use Traits\Controllers\InsurerInsuranceActive;

class SinisterController extends Controller
{
    use TransformData;
    use InsurerInsuranceActive;

    public function index(): bool|array
    {
        return (new Sinister()) -> index();
    }

    public function create(Sinister $sinister): void
    {
        try {
            $upload_files = $sinister -> upload();
            if(is_string($upload_files)){
                throw new Exception($upload_files);
            }
            $new_sinister = $sinister -> create();
            if (is_string($new_sinister)) {
                throw new Exception($new_sinister);
            }
            $id_sinister = (new Sinister($new_sinister));
            foreach ($upload_files as $file) {
                $new_file = (new File($file['id'], $file['name'], $id_sinister)) -> create();
                if (is_string($new_file)) {
                    throw new Exception($new_file);
                }
            }
            $this -> response('Siniestro registrado');
        } catch(Exception $e){
            echo json_encode($e -> getMessage());
        }
    }

    public function show(Sinister $sinister): void
    {
        echo json_encode($sinister -> show());
    }

    public function view(string $view): void
    {
        $status = (new Sinister()) -> estado();
        require_once $view;
    }

    public function update(Sinister $sinister, array $files_update): void
    {
        try {
            $sinister_update = $sinister -> update();
            if(is_string($sinister_update)){
                throw new Exception($sinister_update);
            }
            if ($sinister -> verifyFileService()) {
                $updated_files = $sinister -> updateFiles();
                if(is_string($updated_files)) {
                    throw new Exception($updated_files);
                }
                foreach ($updated_files as $index => $updated_file) {
                    $update_file = (new File($files_update[$index] -> getId(),$updated_file['id'], $updated_file['name'])) -> update();
                    if (is_string($update_file)) {
                        throw new Exception($update_file);
                    }
                }
            }
            $this -> response('Siniestro actualizado');
        } catch (Exception $e) {
            echo json_encode($e -> getMessage());
        }
    }

    public function delete(Sinister $sinister): void
    {
        $sinister -> delete();
        $this -> response('Siniestro eliminado');
    }
}
