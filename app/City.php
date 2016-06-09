<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Товары, которые есть у города
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function products(){
        //у города может быть много товаров
        //через промежуточную таблицу получаем наличие по городам
        //еще бы склад не помешал
        return $this->hasManyThrough('App\Product', 'App\AvailabilityProduct', 'id_city', 'id');
    }
}
