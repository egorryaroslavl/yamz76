<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
	        $table->string( 'name' );
	        $table->string( 'logo' );
	        $table->string( 'address' );
	        $table->string( 'map' );
	        $table->string( 'phone' );
	        $table->string( 'skype' );
	        $table->string( 'email' );
	        $table->string( 'order_email' );
	        $table->string( 'schedule' );
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
        Schema::drop('contacts');
    }
}
