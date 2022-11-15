<?php

namespace Traits\Models;

use ReflectionClass;

trait TConstruct
{
    private function construct(...$args): void
    {
        if (!empty($args)) {
            if (!method_exists($this, $method = '__construct' . func_num_args())) {
                $methods = (new ReflectionClass($this)) -> getMethods();
                $constructs_params = [];
                $methods_possible = [];
                $type_args = array_map(function ($value){
                    $type = gettype($value);
                    return match ($type) {
                        'object' => get_class($value),
                        'integer' => 'int',
                        default => $type,
                    };
                }, $args);
                $methods = array_filter($methods, function ($reflectionMethod){
                    return preg_match('/(__construct(?![0-9]))/', $reflectionMethod -> getName());
                });
                foreach ($methods as $method) {
                    foreach ($method -> getParameters() as $parameter) {
                        $constructs_params[$method -> getName()][] = explode('|', $parameter -> getType());
                    }
                }
                foreach ($constructs_params as $index => $construct) {
                    $c = 0;
                    foreach ($construct as $index2 => $params) {
                        for ($i = 0; $i < count($params); $i++) {
                            if ($params[$i] === $type_args[$index2]) {
                                $c++;
                                break;
                            }
                        }
                    }
                    $methods_possible[$index] = $c;
                }
                $method = array_search(max($methods_possible), $methods_possible);
            }
            call_user_func_array([$this,$method], $args);
        }
    }
}
