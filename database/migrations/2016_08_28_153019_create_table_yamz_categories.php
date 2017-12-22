<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableYamzCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yamz_categories', function (Blueprint $table) {
            $table->increments('id');
                        $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->string('name');
             $table->string('alias');
            $table->text('text');
                $table->string( 'icon' );
                $table->boolean( 'public' )->default( 1 );
                $table->boolean( 'anons' )->default( 0 );
                $table->boolean( 'hit' )->default( 0 );
                $table->integer( 'pos' )->default( 0 );
                $table->string( 'metatag_title' );
                $table->string( 'metatag_description' );
                $table->string( 'metatag_keywords' );
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('yamz_categories');
    }
}
