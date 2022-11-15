<?php

namespace Core;

use Exception;
use ReflectionException;
use Traits\Controllers\TransformData;

class FrontController
{
    use TransformData;

    private array|string $action;

    public function __construct(string $action)
    {
        $this -> action = str_contains($action, '/') ? explode('/', $action) : $action;
    }

    public function run(): void
    {
        if (is_string($this -> action)) {
            $this -> getView();
        } else {
            count($this -> action) === 2 ? $this -> getController(
                'App\Controllers\\' . $this -> action[0] . 'Controller'
            )
                : require_once error('404.php');
        }
    }

    public function getView(): void
    {
        $view = view($this -> action . '.php');
        if (file_exists($view)) {
            $uri = $_SERVER['REQUEST_URI'];
            $uri_lower = strtolower($uri);
            if ($uri === $uri_lower) {
                $routes = require_once 'routes/app.php';
                $controller = $routes[$this -> action] ?? null;
                !empty($controller) ? (new $controller()) -> view($view) : require_once $view;
            } else {
                header('Location: ' . $uri_lower);
            }
        } else {
            require_once error('404.php');
        }
    }

    public function data(array $data): array
    {
        $data = (array_map(function ($value) {
            $json = json_decode($value);
            return json_last_error() == JSON_ERROR_NONE ? $json : $value;
        }, $data));
        return $this -> combine($data);
    }

    public function combine(array $array): array
    {
        foreach ($array as $index => $value) {
            if (is_array($value) || is_object($value)) {
                $array[$index] = $this -> combine((array)$value);
            } elseif(is_string($value) && is_numeric($value)) {
                $array[$index] = str_contains($value,'.') ? floatval($value): intval($value);
            } elseif (preg_match('/(file(?!_))/i', $index)) {
                if(count($_FILES) > 0) {
                    $files = $_FILES;
                    foreach (array_keys($array) as $index2 => $array_key) {
                        if (str_contains($array_key,'file_id')) {
                            $files = array_map(function ($file, $id_file) {
                                return ['id' => $id_file] + $file;
                            },$files, (array)$array[$array_key]);
                            array_splice($array,$index2,1);
                            break;
                        }
                    }
                    $leaked_files = $this -> files($files);
                    if(count($leaked_files) > 1) {
                        $array[$index] = $leaked_files;
                    } else {
                        $first_value = reset($leaked_files);
                        $array[$index] = str_contains($index,'collection') ? ['file0' => $first_value] : $first_value;
                    }
                } else {
                    $array[$index] = null;
                }
            }
        }
        return $array;
    }

    public function files(array $files): array
    {
        return array_map(function ($file){
            return array_filter($file,function ($value,$index){
                return in_array($index,['id','name','tmp_name','type']);
            },ARRAY_FILTER_USE_BOTH);
        }, $files);
    }

    public function getController(string $controller): void
    {
        try {
            if (!empty($_POST)) {
                $data = $this -> transformData($controller, $this -> action[1], $this -> data($_POST));
                if (is_string($data)) {
                    throw new Exception($data);
                }
                $return = call_user_func_array([new $controller(), $this -> action[1]], $data);
                if ($return !== null) {
                    echo json_encode($return);
                }
            } else {
                require_once error('404.php');
            }
        } catch (ReflectionException|Exception $e) {
            echo $e -> getMessage();
        }
    }
}
