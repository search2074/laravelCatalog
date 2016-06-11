<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public $_valias = 'products';

    protected $products;

    /**
     * Конструктор
     * @param ProductRepository $products
     */
    public function __construct(ProductRepository $products) {
        //в этом контроллере есть доступ только у аутентифицированных юзеров
        $this->middleware('auth');
        
        $this->products = $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        //Session::flash('message', 'Это флеш сообщение'); 
        
        $this->validate($request, [
            'sort_by' => 'alpha',
            'direction' => 'alpha'
        ], [
            'alpha' => 'Поле :attribute должно содержать только латинские символы.',
        ]);
        
        $sort_by = $request->get('sort_by');
        $direction = $request->get('direction');
        
        $products = $this->products->findAllForUser($request->user(), $sort_by, $direction);
        
        return view($this->getView('index'), [
            'products' => $products,
            'sort_by' => $sort_by, 
            'direction' => $direction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'article' => 'required|max:255',
            'name' => 'required|max:255',
        ]);

        $request->product()->create([
            'article' => $request->article,
            'name' => $request->name,
            'created_at' => date('c'),
            'updated_at' => date('c')
        ]);

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $this->authorize('show', $product);

//        $product = Product::find($id);

        return view($this->getView('show'), ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function generateList(Request $request) {
		$request->session()->put('id_products', $request->get('Products'));
		$request->session()->put('select_fields', $request->get('select_fields'));

		return redirect()->to('/lists/products');
	}

}
