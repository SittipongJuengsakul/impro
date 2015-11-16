<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UrlPath extends Controller
{
	/**
	 * Login Path
	 *
	 * 
	 * @return string URL form Login Path
	 */
    public static function LoginUrlPath(){

    	return $returnPath = '/auth/login';
	}

	/**
	 * Home for Guest(non-login) Path
	 *
	 * 
	 * @return string URL Guest(non-login) Path
	 */
	public static function GuestHomeUrlPath(){

    	return $returnPath = '/guest/home';
	}


	/**
	 * Home for User(login-pass) Path
	 *
	 * 
	 * @return string URL User(login-pass) Path
	 */
	public static function UserHomeUrlPath(){

    	return $returnPath = '/user/home';
	}

	/**
	 * Show Slider Path
	 *
	 * 
	 * @return string URL Show Sliding Data of meter Path
	 */
	public static function SlideShowDataUrlPath(){

    	return $returnPath = '/user/slideshow';
	}
}
