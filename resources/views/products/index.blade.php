<?php

/*
 * Список товаров
 */



/* @var $products \Illuminate\Database\Eloquent\Collection */

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Доступные товары в городе "{{ Auth::user()->city->name }}"</h3>
    <br />
</div>
<div class="paginator text-center">
	<?php echo $products->appends(['sort_by' => $sort_by, 'direction' => $direction])->render(); ?>
</div>
<div class="container">
    <div class="table-responsive">
        <div class="errors">
            <!-- Отображение ошибок проверки ввода -->
            @include('common.errors')
        </div>
        <form action="/products/generatelist" method="POST">
            {{ csrf_field() }}
            <table class="table table-striped table-hover products-list">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th class="id-column check-column" data-column="id" title="Кликните для выделения столбца">
                            <?= ViewHelper::renderSortColumn('id', 'ID') ?>
                        </th>
                        <th class="article-column check-column" data-column="article" title="Кликните для выделения столбца">
                            <?= ViewHelper::renderSortColumn('article', 'Артикул') ?>
                        </th>
                        <th class="check-column" data-column="name" title="Кликните для выделения столбца">
                            <?= ViewHelper::renderSortColumn('name', 'Название товара') ?>
                        </th>
                        <th class="dt-column check-column" data-column="created_at" title="Кликните для выделения столбца">
                            <?= ViewHelper::renderSortColumn('created_at', 'Дата создания') ?>
                        </th>
                        <th class="dt-column check-column" data-column="updated_at" title="Кликните для выделения столбца">
                            <?= ViewHelper::renderSortColumn('updated_at', 'Дата изменения') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="actions"><span><input class="check-row" type="checkbox" name="Products[]" value="{{$product->id}}" /></span></td>
                            <td>{{$product->id}}</td>
                            <td class="checked-cell">{{$product->article}}</td>
                            <td class="checked-cell"><a href="/products/show/{{$product->id}}">{{$product->name}}</a></td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="select_fields" value="article,name" />
            <input type="submit" value="Сформировать список для рассылки" />
        </form>
    </div>
</div>
<div class="paginator text-center">
	<?php echo $products->appends(['sort_by' => $sort_by, 'direction' => $direction])->render(); ?>
</div>

@endsection