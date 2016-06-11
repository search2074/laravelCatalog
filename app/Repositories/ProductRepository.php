<?php

namespace App\Repositories;

use App\Product;
use App\User;

/**
 * Description of ProductRepository
 *
 * @author skripov.in
 */
class ProductRepository {
    /**
     * Получить все товары, доступные для текущего юзера (для его города)
     * @param User $user
     * @param type $sort_by поле сортировки
     * @param type $direction направление сортировки
     * @param type $c кол-во товаров на странице
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function findAllForUser(User $user, $sort_by, $direction, $c=100){
        $products = $user->city->products();
        
        if($sort_by && $direction){
            $products->orderBy($sort_by, $direction);
        }

        return $products->paginate($c);
    }

    /**
     * Получить все товары
     * @param string $sort_by поле сортировки
     * @param string $direction направление сортировки
     * @param int $c кол-во товаров на странице
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function findAll($sort_by, $direction, $c=100) {
        $products = Product::where('id', '>=', 1);
        
        if($sort_by && $direction){
            $products->orderBy($sort_by, $direction);
        }
        
        return $products->paginate($c);
    }
    
    /**
     * Получить товары по списку id_products из доступных у юзера
     * @param User $user
     * @param type $id_products
     * @return type
     */
    public function findByIDs(User $user, $id_products){
        $products = $user->city->products();
        // TODO: сделать фильтрацию $id_products от sql-inj
        
        return $products->whereIn('products.id', $id_products)->get();
    }
}