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

class Action extends Section implements Initializable
{

	protected $checkAccess = false;
	protected $title;
	protected $alias;


	public function initialize()
	{
		$this->addToNavigation( $priority = 900, function (){
			return \App\Model\Action::count();
		} );

	}


	public function getIcon()
	{
		return 'fa fa-fire';
	}

	public function getTitle()
	{
		return trans( 'Акции' );
	}

	public function getCreateTitle()
	{
		return 'Добавление в Акции';
	}



	public function onDisplay()
	{
		return AdminDisplay::datatables()
			->setApply( function ( $query ){
				$query->orderBy( 'pos' );
			} )
			->setHtmlAttribute( 'class', 'table-actions' )
			->setHtmlAttribute( 'data-table', 'actions' )
			->setTitle( 'Акции' )
			->setColumns(
				AdminColumn::custom()->setLabel( 'Reorder' )
					->setCallback(
						function (){
							return '<input type="hidden" class="table"  name="table" value="actions">';

						}

					)->setWidth( '30px' ),

				AdminColumn::link( 'name', 'Акция' )->setWidth( '50%' ),
				AdminColumn::custom()
					->setLabel( 'Публикуется' )
					->setCallback( function ( \App\Model\Action $model ){
						return $model->public ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
					} )
					->setWidth( '50px' )
					->setHtmlAttribute( 'class', 'text-center' )
					->setOrderable( true )
			)->paginate( 20 );
	}


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
						AdminFormElement::wysiwyg( 'description', 'Описание' ),
						AdminFormElement::textarea( 'short_description', 'Краткое Описание' )->setRows( 2 ),

					];


				} ) //->addColumn


		);
		/* \вторая строка */
		//$form->setItems


		$form->setItems(
			AdminFormElement::columns()
				->addColumn( function (){
					return [
						AdminFormElement::image( 'icon', 'Иконка' ),

					];


				} )

		);

		$form->setItems(
			AdminFormElement::columns()
				->addColumn( function (){
					return [

						AdminFormElement::date( 'public_begin', 'Публикуется с...' )->setFormat('d.m.Y'),


					];

				} )
				->addColumn( function (){
					return [
						AdminFormElement::date( 'public_end', 'Публикуется до...' )->setFormat('d.m.Y'),

					];

				} )//->addColumn


		);
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

				} )


		);
		/* \четвёртая строка */
		//$form->setItems

		return $form;

	}

    public function onCreate()
    {
        return $this->onEdit(null);
    }

}
