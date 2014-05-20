<?php
/**
 * Page Model
 *
 * @property Page $ParentPage
 * @property Page $ChildPage
 */
App::uses('BackendAppModel', 'Backend.Model');
App::uses('Hash','Utility');
class Page extends BackendAppModel {

	public $actsAs = array('Tree','Chocolate.Aliasable');
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'target' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_language' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_robots_tag' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'css_class' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hide_from_nav' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hide_from_sitemap' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'published' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LayoutView' => array(
			'className' => 'CakeLayout.LayoutView'	
		),
		'ParentPage' => array(
			'className' => 'CakeLayout.Page',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildPage' => array(
			'className' => 'CakeLayout.Page',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public function findIdByAlias($alias) {
		$page = $this->find('first',array(
				'conditions'=>array($this->alias.'.alias' => $alias),
				'recursive'=>-1,
				'fields' => array('id')
		));
		if (!$page) 
			return $page;
		
		return $page[$this->alias]['id'];
	}
	
	/**
	 * Returns a tree list with aliases as display field
	 * 
	 * @return array
	 */
	public function generateAliasTreeList() {
		return $this->generateTreeList(null,null,'{n}.'.$this->alias.'.alias','_',null);
	}
	
	/**
	 * Returns nested data set
	 * 
	 * @param int|null $rootNode Id of top item
	 * @return array
	 */
	public function generateNestedData($rootId = null) {
		$conditions = array();
		$fields = null;
		$order = $this->alias . '.lft ASC';
		$recursive = -1;
		$results = $this->find('all', compact('conditions', 'fields', 'order', 'recursive'));
		
		return Hash::nest($results,array('root' => $rootId));
	}
	
	/**
	 * Wrapper for Page::generateNestedData() for usage with aliases
	 * 
	 * @param string $rootAlias
	 * @return array
	 */
	public function generateNestedDataByAlias($rootAlias = null) {
		if ($rootAlias === null)
			return $this->generateNestedData(null);
		
		$id = $this->findIdByAlias($rootAlias);
		if (!$id)
			return array();
		
		return $this->generateNestedData($id);
	}
	
	public function generateNestedList($rootId = null, $params = array()) {
		
		$params = array_merge(array(
			'level' => 0,
			'max_level' => -1		
		),$params);
		
		$pages = $this->generateNestedData($rootId);
		return $this->_nestedList($pages, $params);
	}
	
	public function generateNestedListByAlias($alias = null, $params = array()) {
		
		$rootId = $this->findIdByAlias($alias);
		return $this->generateNestedList($rootId, $params);
	}
	
	protected function _nestedList($pages, $params) {
		$list = array();
		foreach($pages as $page) {
			$listItem = $this->_nestedListItemFromPage($page, $params);
			array_push($list,$listItem);
		}
		return $list;
	}
	
	protected function _nestedListItemFromPage($page, $params) {
		$listItem = array_intersect_key($page[$this->alias], array('title'=>null,'url'=>null,'alias'=>null,'target'=>null,'css_class'=>null));
		
		//correct url
		if ($listItem['url']) {
			if (is_string($listItem['url']) && substr($listItem['url'],0,1) == '/') {
				$listItem['url'] = preg_replace('/^\//', Router::url('/'), $listItem['url']);
			}
		}
		
		$listItem['children'] = $this->_nestedList($page['children'], $params);
	
		return $listItem;
	}
}
