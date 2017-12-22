<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTableProductsYamzCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_yamz_categories', function (Blueprint $table) {
	        $table->integer('product_id');
	        $table->integer('yamz_category_id');
            $table->primary(['product_id', 'yamz_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_yamz_categories');
    }
}
