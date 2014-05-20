<?php
App::uses('BackendAppController','Backend.Controller');

class BackendUsersController extends BackendAppController {

	public $uses = array('Backend.BackendUser');

	public function beforeFilter() {
		parent::beforeFilter();

		// $this->Auth->allow();
		$this->Auth->allow('testtmp', 'testsave', 'testvalidate');
	}

	// 1111111111111111111111111111111111111111111111111111111111
	protected $_iAmAProtectedVariable;
	protected function _iAmAProtectedMethod() {
		echo '__iAmA Protected Method';
	}

	private $__iAmAPrivateVariable;
	private function __iAmAPrivateMethod() {
		echo '__iAmA Private Method';
	}

	public function testtmp(){
		$this->__iAmAPrivateMethod();
		$this->_iAmAProtectedMethod();

		echo '<br>end function<br>';
		die;
	}

	public function testtmp2(){
		$this->__iAmAPrivateMethod();
		$this->_iAmAProtectedMethod();

		echo '<br>end function<br>';
		die;
	}

	//222222222222222222222222222222222222222222222222222222222222222
	public function testsave(){
		$tmp = array(
			array(
				'title' => 'title 1',
				'content' => 'content 1'
			),
			array(
				'title' => 'title 2',
				'content' => 'content 2'
			),
			array(
				'title' => 'title 3',
				'content' => 'content 3'
			)
		);
		$tmp = array(
			array(
				'Post' => array(
					'title' => 'title 1',
					'content' => 'content 1'
				),
				'Comment' => array(
					array(
						'title' => 'title 1',
						'content' => 'content 1'
					),
					array(
						'title' => 'title 2',
						'content' => 'content 2'
					),
					array(
						'title' => 'title 3',
						'content' => 'content 3'
					)
				)
			),
			array(
				'Post' => array(
					'title' => 'title 2',
					'content' => 'content 2'
				),
				'Comment' => array(
					array(
						'title' => 'title 1',
						'content' => 'content 1'
					),
					array(
						'title' => 'title 2',
						'content' => 'content 2'
					),
					array(
						'title' => 'title 3',
						'content' => 'content 3'
					)
				)
			),
			array(
				'Post' => array(
					'title' => 'title 3',
					'content' => 'content 3'
				),
				'Comment' => array(
					array(
						'title' => 'title 1',
						'content' => 'content 1'
					),
					array(
						'title' => 'title 2',
						'content' => 'content 2'
					),
					array(
						'title' => 'title 3',
						'content' => 'content 3'
					)
				)
			)
		);

		$this->loadModel('Backend.Post');
		// if ($this->Post->saveAll($tmp[0])) {
		if ($this->Post->saveAll($tmp)) {
			echo 'save post ok';
		}

		// $this->loadModel('Post');
		// $this->Post->hasMany = array( // Có thể khai báo trực tiếp từ controller cũng được
		// 	'Comment' => array(
		// 		'className' => 'Comment',
		// 		'foreignKey' => 'item_id',
		// 		'conditions' => array('Comment.status' => 'Y'),
		// 		'order' => 'Comment.id DESC',
		// 		'limit' => '3',
		// 		'dependent' => true
		// 	)
		// );
		$datas = $this->Post->find('all', array(
			'fields'     => array('id', 'title', 'content'),
			'conditions' => array(
				'Post.status' => 'Y'
			),
			'order'   => 'Post.id DESC',
			'limit'   => 4,
			'contain' => array(
				'Comment'
			)
		));
		pr($datas);
		die;
	}

	// 333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333
	public function testvalidate(){
		$tmp = array(
			'lastname' => '希望日が不正で',
			'firstname' => 'content 1',
			'mail' => 'namnb@evolable.com',
			'phone' => 'content 1',
			'contact' => 'title 1',
			'preferred1' => 'content 1',
			'preferred2' => 'title 1',
			'question' => 'content 1'
		);
		$this->loadModel('Tmpvalidate');
		if ($this->Tmpvalidate->save($tmp)) {
			echo 'save ok';
		}else{
			pr($this->Tmpvalidate->validationErrors);
		}
		echo '<br>xong';
		// die;
	}

	public function admin_index() {
		$this->Auth->allow();
		$this->BackendUser->recursive = 0;
		$this->set('backendUsers', $this->paginate());
	}

	public function admin_view($id = null) {
		$this->BackendUser->id = $id;
		if (!$this->BackendUser->exists()) {
			throw new NotFoundException(__d('backend','Invalid admin user'));
		}
		$this->set('backendUser', $this->BackendUser->read(null, $id));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BackendUser->create();
			if ($this->BackendUser->save($this->request->data)) {
				$this->Session->setFlash(__d('backend','The admin user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('backend','The admin user could not be saved. Please, try again.'));
			}
		}
		$backendUserGroups = $this->BackendUser->BackendUserGroup->find('list');
		$this->set(compact('backendUserGroups'));
	}

	public function admin_edit($id = null) {
		$this->BackendUser->id = $id;
		if (!$this->BackendUser->exists()) {
			throw new NotFoundException(__d('backend','Invalid admin user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BackendUser->save($this->request->data)) {
				$this->Session->setFlash(__d('backend','The admin user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('backend','The admin user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->BackendUser->read(null, $id);
			unset($this->request->data['BackendUser']['password']);
		}
		$backendUserGroups = $this->BackendUser->BackendUserGroup->find('list');
		$this->set(compact('backendUserGroups'));
	}

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->BackendUser->id = $id;
		if (!$this->BackendUser->exists()) {
			throw new NotFoundException(__d('backend','Invalid admin user'));
		}
		if ($this->BackendUser->delete()) {
			$this->Session->setFlash(__d('backend','Admin user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('backend','Admin user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>