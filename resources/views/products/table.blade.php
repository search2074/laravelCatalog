<?php
/*
 * таблица товаров
 */
/* @var $products \Illuminate\Database\Eloquent\Collection */
/* @var $columns [] */
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            @foreach($columns as $column)
            <th>{{$column}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                @foreach($columns as $column)
                <td>{{$product->$column}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>