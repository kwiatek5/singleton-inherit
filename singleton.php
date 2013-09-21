<?php

abstract class Singleton {
	public static $instance = array();

	protected function __construct() {
		// http://php.net/manual/en/language.oop5.late-static-bindings.php
		echo static::className() . "\n";
	}
	private function __clone() {}

	abstract protected static function className();
	// {return __CLASS__;}

	public static function instance() {
		// http://php.net/manual/en/language.oop5.late-static-bindings.php
		$class = static::className();
		if (!isset(self::$instance[$class])) {
			self::$instance[$class] = new $class();
		}

		return self::$instance[$class];
	}
}

// It must be final class, because inherited class of A will create new instance of A
final class A extends Singleton {
	protected static function className() {return __CLASS__;}

	protected function __construct() {
		echo "This is a A class\n";
	}
}

final class B extends Singleton {
	protected static function className() {return __CLASS__;}

}

// This is an error.
// class AA extends A {
// 	protected static function className() {return __CLASS__;}
// }

A::instance();
B::instance();
A::instance();
B::instance();
// AA::instance();
// AA::instance();
