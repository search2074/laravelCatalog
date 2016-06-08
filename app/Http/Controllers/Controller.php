<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * Алиас
     * @var string
     */
    public $_valias = '';

    /**
     * Добавляет алиас, если он задан
     * @param string $view
     * @return string
     */
    public function getView($view) {
        if($this->_valias){
            return "{$this->_valias}.{$view}";
        }

        return $view;
    }
}
