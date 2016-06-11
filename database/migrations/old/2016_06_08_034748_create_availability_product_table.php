<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailabilityProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//наличие товаров по городам
		//по идее должны еще быть склады, но в данном задании упростим
		Schema::create('availability_product', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->unsignedInteger('id_product');
			$table->unsignedInteger('id_city');
			$table->integer('c');
        });
		
		//добавим внешних ключей
		Schema::table('availability_product', function($table) {
			$table->foreign('id_product')->references('id')->on('products');
			$table->foreign('id_city')->references('id')->on('cities');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('availability_product');
    }
}
