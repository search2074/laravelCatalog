<?php

/* 
 * Карточка товара
 */

?>

@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-body"><h1>Карточка товара</h1></div>
    <div class="panel-body"><b>Название товара:</b> <span>{{$product->name}}</span></div>
</div>
@endsection