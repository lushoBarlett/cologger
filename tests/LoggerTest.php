<?php

use PHPUnit\Framework\TestCase;
use Cologger\Logger;

class LoggerTest extends TestCase {

	public function logger() {
		return [
			[new Logger(__DIR__ . "/cologger.log"), "test"]
		];
	}

	private function fileExistence(string $filename) {
		$this->assertTrue(
			file_exists(__DIR__ . "/$filename")
		);
	}
	
	private function fileRemoval(string $filename) {
		$this->assertTrue(
			unlink(__DIR__ . "/$filename")
		);

		$this->assertFalse(
			file_exists(__DIR__ . "/$filename")
		);
	}

	/**
	 * date format like in Logger class
	 */
	private function date() : string {
		return date(
			"[Y-m-d D] [H:i:s O]"
		);
	}

	private function read(string $filename) {
		return file_get_contents(__DIR__ . "/$filename");
	}

	/**
	 * @dataProvider logger
	 */
	public function testLog(Logger $logger, string $text) {
		$logger->log($text);
		$date = $this->date();

		$this->fileExistence("cologger.log");
		$this->assertEquals(
			"\e[1;37mLOG\t$date:\e[m $text\n",
			$this->read("cologger.log")
		);

		$this->fileRemoval("cologger.log");
	}

	/**
	 * @dataProvider logger
	 */
	public function testNotice(Logger $logger, string $text) {
		$logger->notice($text);
		$date = $this->date();

		$this->fileExistence("cologger.log");
		$this->assertEquals(
			"\e[1;32mNOTICE\t$date:\e[m $text\n",
			$this->read("cologger.log")
		);

		$this->fileRemoval("cologger.log");
	}

	/**
	 * @dataProvider logger
	 */
	public function testWarning(Logger $logger, string $text) {
		$logger->warning($text);
		$date = $this->date();

		$this->fileExistence("cologger.log");
		$this->assertEquals(
			"\e[1;33mWARNING\t$date:\e[m $text\n",
			$this->read("cologger.log")
		);

		$this->fileRemoval("cologger.log");
	}

	/**
	 * @dataProvider logger
	 */
	public function testError(Logger $logger, string $text) {
		$logger->error($text);
		$date = $this->date();

		$this->fileExistence("cologger.log");
		$this->assertEquals(
			"\e[1;31mERROR\t$date:\e[m $text\n",
			$this->read("cologger.log")
		);

		$this->fileRemoval("cologger.log");
	}

	public function testDifferentFile() {
		$logger = new Logger(__DIR__ . "/other.log");
		$logger->log("test");
		$date = $this->date();

		$this->fileExistence("other.log");
		$this->assertEquals(
			"\e[1;37mLOG\t$date:\e[m test\n",
			$this->read("other.log")
		);

		$this->fileRemoval("other.log");
	}
	
	public function testConsole() {
		$logger = new Logger("nonexistent.log", true);
	
		$logger->log("test");
		$logger->notice("test");
		$logger->warning("test");
		$logger->error("test");

		$this->assertFalse(
			file_exists("nonexistent.log")
		);
	}
}

