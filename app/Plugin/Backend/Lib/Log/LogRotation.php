<?php
App::uses('Folder','Utility');
App::uses('File','Utility');
App::uses('CakeEmail','Network/Email');

class LogRotation {
	
	public $config = array();
	
	public $log = array();
	
	public function __construct($config = array()) {
		
		// load from backend config
		if (is_string($config)) {
			$alias = $config;
			$config = Configure::read('Backend.LogRotation.'.$alias);
		}
		
		if (!$config || !is_array($config)) {
			throw new Exception('Invalid LogRotation config');
		}
		
		$this->config = am(array(
			'path' => '', // Log file name or full path to file
			'keep' => 3, // Number of old logs to keep
			'schedule' => 'daily', // daily, weekly, monthly
			'compress' => false, // Compress
			'compress_delay' => false, // Compress on next cycle
			'rotate_empty' => false, // Rotate even if log file is empty
			'email_to' => null, // Email log before deleting. Value must be compatible to CakeEmail::to()
		),$config);
		
	}
	
	public function rotate() {
		
		try {
			$this->_rotate($this->config);
		} catch(Exception $e) {
			CakeLog::error('LogRotation::rotate() - '.$e->getMessage(),'backend');
			return false;
		}
		return true;
	}
	
	protected function _getFile($path, $i = 0, $create = false) {
		
		if ($i>0) {
			$path = $path.'.'.$i;
		}
		return new File($path,$create);
	}
	
	protected function _rotate($config) {

		// do rotation
		$path = $config['path'];
		for ($i = $config['keep']; $i >= 0; $i--) {
			
			switch (true) {
				case $i == $config['keep']:
					
					$SrcFile = $this->_getFile($path,$i);
					if (!$SrcFile->exists()) {
						continue;
					}
					
					// send report mail
					if ($config['email_to']) {
						try {
							//TODO use dependency injection
							//TODO use backend-wide email report settings					
							$email = new CakeEmail(array(
								'transport' => 'Mail',
								'from' => 'report@'.gethostname(), //TODO email_from should be configured somewhere!
								'to' => $config['email_to'],
								'subject' => 'Log report',
								'emailFormat' => 'text',
								'template' => false,
								'layout' => false
							));
							$email->addAttachments($SrcFile->path);
							$email->send('Log file attached');
						} catch(Exception $e) {
							CakeLog::warning('LogRotation::rotate() - '.$e->getMessage(),'backend');
						}
					}
					break;
					
				case $i > 0:
					
					$SrcFile = $this->_getFile($path,$i);
					if (!$SrcFile->exists()) {
						continue;
					}

					if (!$config['rotate_empty'] && $SrcFile->size() < 1) {
						#if (!$SrcFile->delete())
						#	$this->log[] = "Failed to delete file";
						continue;
					}
					
					$NewFile = $this->_getFile($path,$i+1, true);
					if (!$NewFile->write($SrcFile->read()))
						throw new Exception("Failed to copy log $path.'.'.$i");
					
					if ($i == 1 && !$config['compress'] && $config['compress_delay']) {
						$this->_compress($NewFile);
					}
					
					break;
					
				case $i == 0:
					
					$SrcFile = $this->_getFile($path);

					if (!$config['rotate_empty'] && $SrcFile->size() < 1) {
						continue;
					}

					$NewFile = $this->_getFile($path, $i+1, true);
					if (!$NewFile->write($SrcFile->read()))
						throw new Exception("Failed to copy log $path");
					
					if ($config['compress']) {
						$this->_compress($NewFile);
					}
					
					if (!$SrcFile->write(""))
						throw new Exception("Failed to create empty log $path");
					
					break;
					
				default:
					throw new Exception("Fatal Error");
					break;
			}
			
		}
	}
	
	protected function _compress(File $f) {
		//TODO compress file
		$this->log[] = "Compressing file. Not implemented yet!";
	}
	
}