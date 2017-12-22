<?php

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateClientsTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create( 'clients', function ( Blueprint $table ){
				$table->increments( 'id' );
				$table->string( 'name' );
				$table->string( 'alias' );
				$table->string( 'logo' );
				$table->text( 'description' );
				$table->string( 'short_description' );
				$table->boolean( 'public' )->default( 1 );
				$table->boolean( 'anons' )->default( 0 );
				$table->boolean( 'hit' )->default( 0 );
				$table->integer( 'pos' )->default( 0 );
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
			Schema::drop( 'clients' );
		}
	}
