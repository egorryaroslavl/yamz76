<?php

	use App\Model\YamzCategory;
	use SleepingOwl\Admin\Display\DisplayTree;
	use SleepingOwl\Admin\Model\ModelConfiguration;

	AdminSection::registerModel( YamzCategory::class, function ( ModelConfiguration $model ){
		$model->setTitle( 'Категории:' );
		// Display
		$model->onDisplay( function (){
			return AdminDisplay::tree()
				->setValue( 'name' );
		} );
		// Create And Edit
/*		$model->onCreateAndEdit( function (){
			$list = YamzCategory::getNestedList( 'name', 'id', '...' );
			return AdminForm::form()
				->setItems( [
						AdminFormElement::text( 'name', 'Название' )->required()->unique(),
						AdminFormElement::text( 'alias', 'Алиас' )->required()->unique(),
						AdminFormElement::image( 'icon', 'Иконка' ),
						AdminFormElement::ckeditor( 'text', 'Описание' ),
						AdminFormElement::checkbox( 'public', 'Публикуется' ),
						AdminFormElement::checkbox( 'hit', 'Хит' ),
						AdminFormElement::checkbox( 'anons', 'Анонс' )


					]
				);


		} );*/

		$model->onCreateAndEdit(function() {
			return $form = AdminForm::panel()->addBody(
				AdminFormElement::text( 'name', 'Название' )->required()->unique(),
				AdminFormElement::text( 'alias', 'Алиас' )->required()->unique(),
				AdminFormElement::image( 'icon', 'Иконка' ),
				AdminFormElement::ckeditor( 'text', 'Описание' ),
				AdminFormElement::checkbox( 'public', 'Публикуется' ),
				AdminFormElement::checkbox( 'hit', 'Хит' ),
				AdminFormElement::checkbox( 'anons', 'Анонс' ),
				AdminFormElement::text( 'metatag_title', 'Title' ),
				AdminFormElement::text( 'metatag_description', 'Description' ),
				AdminFormElement::text( 'metatag_keywords', 'Keywords' )


			);

		});


	} )->addMenuPage( YamzCategory::class )->setIcon( 'fa fa-sitemap' );



