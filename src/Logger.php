<?php

namespace Cologger;

class Logger {

	private $file;
	private $console;

	public function __construct(
		string $file = __DIR__ . DIRECTORY_SEPARATOR . "cologger.log",
		bool $console = false
	) {
		$this->file = $file;
		$this->console = $console;
	}

	private function append(string $message) : bool {
		if ($this->console) {
			echo $message . "\n";
			return true;
		}
		$b = file_put_contents(
			$this->file,
			$message . "\n",
			FILE_APPEND
		);
		if ($b === false)
			return $b;
		return true;
	}

	private function date() : string {
		return date( 
			"[Y-m-d D] [H:i:s O]"
		);
	}

	public function error(string $error) : void {
		$date = $this->date();
		$this->append(
			"\e[1;31mERROR\t$date:\e[m $error"
		);
	}

	public function warning(string $warning) : void {
		$date = $this->date();
		$this->append(
			"\e[1;33mWARNING\t$date:\e[m $warning"
		);
	}

	public function notice(string $notice) : void {
		$date = $this->date();
		$this->append(
			"\e[1;32mNOTICE\t$date:\e[m $notice"
		);
	}

	public function log(string $log) : void {
		$date = $this->date();
		$this->append(
			"\e[1;37mLOG\t$date:\e[m $log"
		);
	}
}

?>
