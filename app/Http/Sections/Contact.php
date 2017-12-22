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


	class Contact extends Section implements Initializable
	{
		/**
		 * @var bool
		 */
		protected $checkAccess = false;

		/**
		 * @var string
		 */
		protected $title;

		/**
		 * @var string
		 */
		protected $alias;

		public function initialize()
		{
			// Добавление пункта меню и счетчика кол-ва записей в разделе
			$this->addToNavigation( $priority = 600, function (){
				return \App\Model\Contact::count();
			} );

		}


		public function getIcon()
		{
			return 'fa fa-money';
		}

		public function getTitle()
		{
			return trans( 'Контакты' );
		}


		/**
		 * @return DisplayInterface
		 */
		public function onDisplay()
		{
			return AdminDisplay::table()
				->setApply( function ( $query ){
					$query->where( 'id',1 );
				} )
				->setHtmlAttribute( 'class', 'table-contact' )
				->setTitle( 'Офис' )
				->setColumns(
					AdminColumn::link( 'name', 'Офисы' )->setWidth( '100px' )
				)->paginate( 10 );
		}

		/**
		 * @param int $id
		 *
		 * @return FormInterface
		 */
		public function onEdit( $id )
		{
			$form = AdminForm::panel();

			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::text( 'name', 'Имя офиса' )->required()->unique(),
						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::text( 'alias', 'Алиас' )->required()->unique(),
						];

					} )

					->addColumn( function (){
						return [
							AdminFormElement::text( 'company_name', 'Название компании' )->required()->unique(),
						];

					} )



			);



			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::image( 'icon', 'Лого' ),
						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'rekvizity', 'Реквизиты' )->setRows(8),
						];

					} )


			);


			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::text( 'address', 'Адрес' ),

						];
					} )//->addColumn


					->addColumn( function (){
						return [
							AdminFormElement::text( 'address_yurid', 'Адрес юридический' ),

						];
					} ) //->addColumn


			);


			$form->SetItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'map', 'Карта' )->setRows(2),
						];
					} ) //->addColumn
			);


			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::text( 'phone', 'Телефон/телефоны' ),

						];
					} )//->addColumn

					->addColumn( function (){
						return [
							AdminFormElement::text( 'skype', 'Skype' ),
						];
					} ) //->addColumn
			);

			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::text( 'email', 'Email' ),

						];
					} )//->addColumn

					->addColumn( function (){
						return [
							AdminFormElement::text( 'order_email', 'Email для заявок' ),
						];
					} ) //->addColumn
			);

			$form->setItems(
				AdminFormElement::columns()
					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'metatag_title', 'metatag Title' )->setRows( 1 )
						];

					} )
					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'metatag_description', 'metatag Description' )->setRows( 1 )
						];

					} )//->addColumn

					->addColumn( function (){
						return [
							AdminFormElement::textarea( 'metatag_keywords', 'metatag Keywords' )->setRows( 1 )
						];

					} ) //->addColumn


			);


			return $form;

		}


		/**
		 * @return FormInterface
		 */
		public function onCreate()
		{
			return $this->onEdit( null );
		}



	}
