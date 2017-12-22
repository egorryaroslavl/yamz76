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


	class Seo extends Section implements Initializable
	{

		public function initialize()
		{
			$this->addToNavigation( $priority = 1500, function (){
				return \App\Model\Seo::count();
			} );

		}

		public function getIcon()
		{
			return 'fa fa-line-chart';
		}

		public function getTitle()
		{
			return trans( 'SEO' );
		}

		public function getCreateTitle()
		{
			return 'Добавление в SEO';
		}

		public function onDisplay()
		{
			return AdminDisplay::datatables()
				->setApply( function ( $query ){
					$query->orderBy( 'id' );
				} )
				->setHtmlAttribute( 'class', 'table-seos' )
				->setHtmlAttribute( 'data-table', 'seos' )
				->setTitle( 'SEO' )
				->setColumns(
					AdminColumn::custom()->setLabel( 'Reorder' )
						->setCallback(
							function (){
								return '<input type="hidden" class="table"  name="table" value="seos">';

							}

						)->setWidth( '30px' ),
					AdminColumn::link( 'name', 'URL' )->setWidth( '30%' ),
					AdminColumn::link( 'alias', 'Имя' )->setWidth( '30%' ),
					AdminColumn::custom()
						->setLabel( 'Публикуется' )
						->setCallback( function ( \App\Model\Seo $model ){
							return $model->public ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
						} )
						->setWidth( '50px' )
						->setHtmlAttribute( 'class', 'text-center' )
				)->paginate( 20 );
		}


		public function onEdit()
		{
			$form = AdminForm::panel();

			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::text( 'name', 'URL' )
								->required()
								->unique(),
						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::text( 'alias', 'Алиас' )->required()->unique(),
						];

					} )


			);

			/*			$form->setItems(
							AdminFormElement::columns()

								->addColumn( function (){
									return [
										AdminFormElement::checkbox( 'public', 'Публикуется' ),
									];

								} )

						);*/


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

					} )
			);

			return $form;

		}


		public function onCreate()
		{
			return $this->onEdit( null );
		}

	}
