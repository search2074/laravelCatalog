<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function getPaginated(array $params, $pages=25) {
        if(self::isSortable($params)){
            return self::orderBy($params['sort_by'], $params['direction'])->paginate($pages);
        }
        
        return self::paginate($pages);
    }
    
    protected static function isSortable(array $params) {
        if(!empty($params['sort_by']) && !empty($params['direction'])){
            return $params['sort_by'] && $params['direction'];
        }
        
        return false;
    }
}
