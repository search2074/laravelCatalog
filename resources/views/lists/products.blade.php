<?php

/*
 * Список товаров для отправки по e-mail
 */

/* @var $products \Illuminate\Database\Eloquent\Collection */

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ваш список товаров</h3>
    <br />
</div>
<div class="container">
    <div class="table-responsive">
        <div class="errors">
            <!-- Отображение ошибок проверки ввода -->
            @include('common.errors')
        </div>
        <form action="/lists/send" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            @include('products.table')
            
			<div>
				<label for="providers-list">Получатель <span class="text-danger">*</span></label>
				<br />
				<?=	Form::select('providerslist[]', $providers, NULL, ['id'=>'providers-list', 'multiple'=>'multiple']); ?>
			</div>
			<br />
			<div>
				<label for="file">Прикрепить изображение</label>
				<input id="file" name="file" type="file" />
			</div>
            
			<br />
			<br />
			
            <input type="submit" value="Отправить" />
        </form>
    </div>
</div>
@endsection