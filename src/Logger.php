<?php

namespace PoliServer;

class Logger {

	public static $logf = __DIR__ . DIRECTORY_SEPARATOR . "logger.log";
	public static $console = false;

	private static function append(string $message) : bool {
		if (self::$console) {
			echo $message . "\n";
			return true;
		}
		$b = file_put_contents(
			self::$logf,
			$message . "\n",
			FILE_APPEND
		);
		if ($b === false)
			return $b;
		return true;
	}

	private static function date() : string {
		return date( 
			"[Y-m-d D] [H:i:s O]"
		);
	}

	public static function error(string $error) : void {
		$date = self::date();
		self::append(
			"\e[1;31mERROR\t$date:\e[m $error"
		);
	}

	public static function warning(string $warning) : void {
		$date = self::date();
		self::append(
			"\e[1;33mWARNING\t$date:\e[m $warning"
		);
	}

	public static function notice(string $notice) : void {
		$date = self::date();
		self::append(
			"\e[1;32mNOTICE\t$date:\e[m $notice"
		);
	}

	public static function log(string $log) : void {
		$date = self::date();
		self::append(
			"\e[1;37mLOG\t$date:\e[m $log"
		);
	}
}

?>
