<?php

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateSeosTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create( 'seos', function ( Blueprint $table ){
				$table->increments( 'id' );
				$table->string( 'name' );
				$table->string( 'alias' );
				$table->boolean( 'public' )->default( 1 );
				$table->string( 'metatag_title' );
				$table->string( 'metatag_description' );
				$table->string( 'metatag_keywords' );
				$table->timestamps();
			} );
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop( 'seos' );
		}
	}
