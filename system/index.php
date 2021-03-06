﻿<?php

	// error_reporting(0);

	date_default_timezone_set('Etc/GMT-11');
	define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);

	set_include_path(__ROOT__.'/system/');

	foreach ([

		'DataBase.php',
		'User.php',
		'View.php',
		'File.php',

		'Route.php'

	] as $script) { include_once $script; }










	/*
		COOKIE
	*/

	function cookie($key, $value = null) {

		$time = isset($value) ? time() + 86400 : -1; // 24h

		return func_num_args() > 1 ?

		setcookie($key, $value, $time, '/') :
		($_COOKIE[$key] ?? null);
	}










	/*
		CRYPT
	*/

	function secret($string, $hash = null) {

		$salt = 'sakmadik';

		return $hash ?

		password_verify($string. $salt, $hash) :
		password_hash($string. $salt, CRYPT_SHA256);
	}










	/*
		BITMASK
	*/

	function bitmask($data) {

		$bitmask = null;

		if (is_array($data)) {

			foreach ($data as $bit) { $bitmask |= $bit; }

		} else {

			$bitmask = [];

			for ($i=0; pow(2, $i) <= $data; $i++) {

				if (pow(2, $i) & $data)
				array_push($bitmask, pow(2, $i));
			}
		}

		return $bitmask;
	}










	/*
		each class public variables
	*/

	function assignClassData($class, $data) {

		array_map(function($key) use ($class, $data) {

			$class->{$key->name} =
			$data->{$key->name} ?? null;

		}, (new ReflectionClass($class))
		->getProperties(ReflectionProperty::IS_PUBLIC));
	}










	/*
		unset global
	*/

	function globalUnset($variable) {

		unset($GLOBALS[$variable]);
	}

	/*
		return null if string = ""
	*/

	function nullstr($string) {

		return $string ? $string : null;
	}
?>
