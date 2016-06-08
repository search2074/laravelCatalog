<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public $_valias = 'products';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        // TODO: фильтрация входящих гет данных, чтобы не было sql-inj
        $sort_by = $request->get('sort_by');
        $direction = $request->get('direction');

        $products = Product::getPaginated([
            'sort_by' => $sort_by,
            'direction' => $direction
        ], 100);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

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

}
