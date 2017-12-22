<?php
namespace App\Http\Controllers;

use App\Http\Controllers\SeosController;
use App\Http\Requests\Request;


?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php  if( !isset( $data ) ) $data = false; ?>
	<?php // dd($data->articul)     ?>
	<title>{{ SeosController::title( $data ) }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	<meta name="description" content="{{  SeosController::description($data) }}">
	<meta name="keywords" content="{{  SeosController::keywords($data) }}">
	<link href="/gear/css/bootstrap.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
	      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="/gear/css/ionicons.css" rel="stylesheet">
	<link href="/gear/css/revolution.css" rel="stylesheet">
	<link href="/gear/css/owl.carousel.css" rel="stylesheet">
	<link href="/js/bs_pagination/jquery.bs_pagination.min.css" rel="stylesheet">
	<link href="/css/animate.css" rel="stylesheet">
	<link href="/gear/css/style.css" rel="stylesheet">
	{{ \HTML::style('/assets/sweetalert-master/dist/sweetalert.css') }}
	<link
		href="/css/shopi-cart-10/stylesheet/stylesheet.css" rel="stylesheet">{{ \HTML::style('/css/common.css') }}
</head>