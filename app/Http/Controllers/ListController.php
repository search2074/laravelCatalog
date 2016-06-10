<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Session;

/**
 * Description of ListController
 *
 * @author User
 */
class ListController extends Controller {
    public function products(Request $request){
        print_r($_REQUEST);
    }
}
