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
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="id-column"><?= ViewHelper::renderSortColumn('id', 'ID') ?></th>
                    <th class="article-column"><?= ViewHelper::renderSortColumn('article', 'Артикул') ?></th>
                    <th><?= ViewHelper::renderSortColumn('name', 'Название товара') ?></th>
                    <th class="dt-column"><?= ViewHelper::renderSortColumn('created_at', 'Дата создания') ?></th>
                    <th class="dt-column"><?= ViewHelper::renderSortColumn('updated_at', 'Дата изменения') ?></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <?php /*<li><a href="/show/{{$product->id}}">{{$product->name}}</a></li>*/ ?>
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->article}}</td>
                        <td><a href="/products/show/{{$product->id}}">{{$product->name}}</a></td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="paginator text-center">
	<?php echo $products->appends(['sort_by' => $sort_by, 'direction' => $direction])->render(); ?>
</div>

@endsection

<style>
    .id-column {
        min-width: 75px;
    }
    .article-column {
        min-width: 115px;
    }
    .dt-column {
        min-width: 160px;
    }
</style>