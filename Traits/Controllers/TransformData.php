<?php

namespace Traits\Controllers;

use Exception;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;

trait TransformData
{
    public function getTypeParameters(string $class, string $method, ReflectionParameter $parameter) :array
    {
        $parameters = [];
        foreach (preg_split("/[|?]/",strval($parameter -> getType())) as $type) {
            if(class_exists($type)) {
                $parameters['classes'][] = $type;
            } elseif ($type === 'array') {
                $collection = require 'App/collection.php';
                if (array_key_exists($class,$collection) && in_array($method, $collection[$class][0])) {
                    $obj_collection = $collection[$class][1];
                    if(is_array($obj_collection)) {
                        $parameter_name = $parameter -> getName();
                        foreach ($obj_collection as $index => $value) {
                            if($index === $parameter_name){
                                $parameters['collection'] = $value;
                            }
                        }
                    } else {
                        $parameters['collection'] = $collection[$class][1];
                    }
                } else {
                    $parameters['others'][] = $type;
                }
            } else {
                $parameters['others'][] = $type;
            }
        }
        return $parameters;
    }

    public function getClass(int|string $info_data, array $parameters): array|null|string
    {
        try {
            if(str_contains($info_data,'collection') || (count($parameters) === 1 && array_key_exists('collection',
                        $parameters))) {
                $class = [$parameters['collection'],true];
            } elseif (count($parameters) > 1) {
                $classes = $parameters['classes'];
                for ($i = 0; $i < count($classes); $i++) {
                    if (str_contains($classes[$i], $info_data)) {
                        $class = [$classes[$i]];
                    }
                }
                if (!isset($class)) {
                    if(array_key_exists('others',$parameters)){
                        $class = null;
                    } else {
                        throw new Exception('No se pudo encontrar la clase');
                    }
                }
            } else {
                $class = [$parameters['classes'][0]];
            }
            return $class;
        } catch (Exception $e) {
            return $e -> getMessage();
        }
    }

    public function getMethod(array $use_class, array $array, array $info_data) :Exception|string
    {
        try {
            $methods = [
                array_key_exists(1,$use_class) ? count((array)reset($array)) : count($array),
                array_key_exists(1, $info_data) ? $info_data[1] : $info_data[0]
            ];
            for ($i = 0; $i < count($methods); $i++) {
                if (method_exists($use_class[0], $method_name = '__construct' . $methods[$i])) {
                    $method = $method_name;
                }
            }
            return $method ?? throw new Exception('Método no encontrado para ' . $use_class[0]);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function instance(string $use_class, string $use_method, array $array): object|string
    {
        try {
            $array = $this -> transformData($use_class, $use_method, $array);
            if (is_string($array)) {
                throw new Exception('No se pudieron transformar los datos. ' . $array);
            }
            $array = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $array);
            call_user_func_array([$new = new $use_class(),'__construct'],$array);
            return $new;
        } catch (Exception $e) {
            return $e -> getMessage();
        }
    }

    public function transformData(string $class, string $method, array $data): array|string
    {
        try {
            $reflection_method = new ReflectionMethod($class, $method);
            foreach ($reflection_method -> getParameters() as $index => $parameter) {
                $parameters = $this -> getTypeParameters($class,$method,$parameter);
                if (array_key_exists('classes',$parameters) || array_key_exists('collection',$parameters)) {
                    $one_parameter = $reflection_method -> getNumberOfParameters() === 1;
                    $array = $one_parameter ? $data : (array)array_values($data)[$index];
                    if(!((count($array) === 1 && empty(reset($array))) || empty($array))) {
                        $info_data = explode('_', array_keys($data)[$index]);
                        $use_class = $this -> getClass($info_data[0],$parameters);
                        if(is_string($use_class)) {
                            throw new Exception($use_class);
                        }
                        if($use_class !== null) {
                            if(is_object($use_method = $this -> getMethod($use_class, $array, $info_data))) {
                                throw new Exception($use_method -> getMessage());
                            }
                            if (array_key_exists(1,$use_class)) {
                                foreach ($array as $index_collection => $value) {
                                    $array[$index_collection] = $this -> instance($use_class[0],$use_method,(array)
                                    $value);
                                    if(is_string($array[$index_collection])){
                                        throw new Exception($array[$index_collection]);
                                    }
                                }
                                $data = $one_parameter
                                    ? $array
                                    : array_replace($data, [array_keys($data)[$index] =>
                                        $array]);
                            } else {
                                $array = $this -> instance($use_class[0],$use_method,$array);
                                if (is_string($array)) {
                                    throw new Exception($array);
                                }
                                $data = array_replace($data, [array_keys($data)[$index] => $array]);
                            }
                            $use_method = null;
                        }
                    }
                }
            }
            return array_values($data);
        } catch (ReflectionException|Exception $e) {
            return $e -> getMessage();
        }
    }
}