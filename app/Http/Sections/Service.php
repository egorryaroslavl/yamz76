<?php

	namespace App\Http\Sections;

	use AdminColumn;
	use AdminDisplay;
	use AdminForm;
	use AdminFormElement;
	use SleepingOwl\Admin\Contracts\DisplayInterface;
	use SleepingOwl\Admin\Contracts\FormInterface;
	use SleepingOwl\Admin\Contracts\Initializable;
	use SleepingOwl\Admin\Section;


	class Service extends Section implements Initializable
	{

		protected $checkAccess = false;
		protected $title;
		protected $alias;


		public function initialize()
		{
			// Добавление пункта меню и счетчика кол-ва записей в разделе
			$this->addToNavigation( $priority = 100, function (){
				return \App\Model\Service::count();
			} );

		}

		public function getIcon()
		{
			return 'fa fa-cubes';
		}

		public function getTitle()
		{
			return trans( 'Услуги' );
		}

		public function getCreateTitle()
		{
			return 'Добавление в Услуги';
		}

		/**
		 * @return DisplayInterface
		 */
		public function onDisplay()
		{
			return AdminDisplay::datatables()
				->setApply( function ( $query ){
					$query->orderBy( 'pos' );
				} )
				->setHtmlAttribute( 'class', 'table-services' )
				->setHtmlAttribute( 'data-table', 'services' )
				->setTitle( 'Статьи' )
				->setColumns(
					AdminColumn::custom()->setLabel( 'Reorder' )
						->setCallback(
							function (){
								return '<input type="hidden" class="table"  name="table" value="services">';

							}

						)->setWidth( '30px' ),

					AdminColumn::link( 'name', 'Статья' )->setWidth( '50%' ),
					AdminColumn::custom()
						->setLabel( 'Публикуется' )
						->setCallback( function ( \App\Model\Service $model ){
							return $model->public ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
						} )->setWidth( '50px' )->setHtmlAttribute( 'class', 'text-center' )->setOrderable( true )
				)->paginate( 20 );
		}

		/**
		 * @param int $id
		 *
		 * @return FormInterface
		 */
		public function onEdit( $id )
		{
			$form = AdminForm::panel();

			/* первая строка */
			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::text( 'name', 'Имя' )->required()->unique(),
						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::text( 'alias', 'Алиас' )->required()->unique(),
						];

					} ) //->addColumn


			);
			//$form->setItems


			/* вторая строка */
			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::image( 'icon', 'Иконка' ),

						];


					} )  //->addColumn

					->addColumn( function (){
						return [
							AdminFormElement::wysiwyg( 'description', 'Описание' ),
							AdminFormElement::textarea( 'short_description', 'Краткое Описание' )->setRows( 2 ),

						];


					} ) //->addColumn


			);
			/* \вторая строка */
			//$form->setItems


			/* третья строка */
			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [

							AdminFormElement::checkbox( 'public', 'Публикуется' ),


						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::checkbox( 'anons', 'Анонс' ),

						];

					} )//->addColumn

					->addColumn( function (){
						return [
							AdminFormElement::checkbox( 'hit', 'Хит' ),

						];

					} ) //->addColumn
			);
			/* \третья строка */
			//$form->setItems


			/* четвёртая строка */
			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'metatag_title', 'metatag Title' )->setRows( 1 )
						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'metatag_keywords', 'metatag Keywords' )->setRows( 1 )
						];

					} )//->addColumn

					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'metatag_description', 'metatag Description' )->setRows( 1 )

						];

					} ) //->addColumn
			);
			/* \четвёртая строка */
			//$form->setItems

			return $form;

		}

		/**
		 * @return FormInterface
		 */
		public function onCreate()
		{
			return $this->onEdit( null );
		}

		/**
		 * @return void
		 */
		public function onDelete( $id )
		{
			// todo: remove if unused
		}

		/**
		 * @return void
		 */
		public function onRestore( $id )
		{
			// todo: remove if unused
		}
	}
