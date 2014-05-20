<?php
App::uses('Folder','Utility');

class CacheTask extends AppShell {

	public function getOptionParser() {
		$parser = parent::getOptionParser();
		$parser->description(__d('backend',"Manage Cache"));
		
		$parser->addArgument('command',array(
				'help' => 'Command',
				'required' => true,
				'choices' => array('clear')
		));	
		
		return $parser;
	}

	public function main() {
		call_user_func(array($this,$this->args[0]));
	}
	

	public function clear() {
		
		$this->out("Cleanup CACHE directories");
		
		$dirs = array("models","persistent","views");
		
		$i = $failed = 0;
		foreach($dirs as $dir) {
			$this->hr();
			$path = CACHE.$dir;
			if (!is_dir($path)) {
				$this->out("<error>$path is not a directory</error>");
				continue;
			}
			$this->out("<info>Clear directory $path</info>");
			$Folder = new Folder($path);
			list(,$files) = $Folder->read(true, array('.','empty'),true);
			foreach($files as $file) {
				if (!unlink($file)) {
					$failed++;
					$this->out("<error>Failed to delete file $file</error>");
					continue;
				}
				$this->out("<success>Deleted file $file</success>");
				$i++;
			}
		}
		$this->out("<success>$i files deleted</success>");
		$this->out("<error>$failed files failed</error>");
		$this->hr();
	}
	
}