<?php
App::uses('LogRotation','Backend.Log');

class LogRotationTest extends CakeTestCase {
	
	public $tmpDir;
	
	public function setUp() {
		parent::setUp();
		
		// create tmp folder
		$this->tmpDir = TMP."tests".DS."log_rotation".DS;
		if (!is_dir($this->tmpDir)) {
			mkdir($this->tmpDir,0777,true);
		}
	}
	
	public function testRotate() {
		
		// create test logfile
		$path = $this->tmpDir . "test.log";
		file_put_contents($path, "A test log row");
		
		$config = array(
			'path' => $path		
		);
		$LogRotation = new TestLogRotation($config);
		$LogRotation->rotate();
		
	}
	
	public function tearDown() {
		parent::tearDown();
		
		// remove tmp folder
		$this->__rrmdir($this->tmpDir);
	}
	
	private function __rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}	
}

class TestLogRotation extends LogRotation {
	
}