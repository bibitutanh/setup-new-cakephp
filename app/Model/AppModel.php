<?php
class AppModel extends Model{
	var $actsAs = array('Containable');

	var $cache_query = true;
	function find($type = 'first', $query = array() )
	{
		$params = $query;
		if( $type == 'first' && $this->name == 'User' )
			return parent::find($type, $params);
	  	if ( $this->cache_query && $this->name != 'Session') {
			$tag = isset($this->name) ? $this->name : 'appmodel';
			$paramsHash = md5(serialize($params));
			$version = (int)Cache::read($tag);
			$fullTag = $tag . '_' . $type . '_' . $paramsHash;
			if ($result = Cache::read($fullTag))
			  if ($result['version'] == $version)
				  return $result['data'];
			$result = array('version' => $version, 'data' => parent::find($type, $params));
			Cache::write($fullTag, $result);
			Cache::write($tag, $version);

			return $result['data'];
		} else
			return parent::find($type, $params);
	}

	function updateCounter($tag = null)
	{
		if ($this->cache_query) {
			if( is_array($tag) )
			{
				foreach( $tag as $value )
				{
					Cache::write($value, 1 + (int)Cache::read($value));
				}
			}else{
				if(!isset($tag)){ $tag = isset($this->name) ? $this->name : 'appmodel'; }
				Cache::write($tag, 1 + (int)Cache::read($tag));
			}
		}

		// $this->log($tag);
	}

	function afterSave($created, $options = array())
	{
		$this->updateCounter();
		parent::afterSave($created);
	}

	function beforeSave($options = array()) {

		if( ( !isset($this->data['creator']) && !isset($this->data[$this->name]['creator']) )
				|| (isset($this->data['creator']) && $this->data['creator'] == 0)
				|| (isset($this->data[$this->name]['creator']) && $this->data[$this->name]['creator'] == 0)
		)
		{
			App::uses('AuthComponent', 'Controller/Component');
			$Auth = new AuthComponent(new ComponentCollection());
			$user_login_id = $Auth->user('id');
			if( !is_numeric($user_login_id) )$user_login_id = 0;
			$this->set(array('modifier' => $user_login_id));
			if (!isset($this->data[$this->name]['id']) && !isset($this->data['id']) && !$this->id)
				$this->set(array('creator' => $user_login_id));
		}

		parent::beforeSave($options);
		return true;
	}
}
