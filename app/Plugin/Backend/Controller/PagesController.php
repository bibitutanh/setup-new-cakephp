<?php
App::uses('CakeLayoutAppController', 'CakeLayout.Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends BackendAppController {
	
	
	public function aliased($alias) {
		
		$page = $this->Page->findByAlias($alias);
		
		
		$this->layout = $page['LayoutView']['path'];
		
		$this->set(compact('page'));
	}
	

	public function admin_list($root = null) {
		$params = array_merge(array(
			'root_node' => $root	
		),$this->passedArgs);
		
		$pageTree = $this->Page->generateNestedDataByAlias($params['root_node']);
		$nestedList = $this->Page->generateNestedListByAlias($params['root_node']);
		
		if ($this->request->isRequested()) 
			return $nestedList;
		
		$this->set(compact('pageTree','nestedList'));
	}
	
	public function admin_request_pages($parent_id = null) {
		return $this->Page->generateNestedDataByAlias($parent_id);
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		$this->paginate = array(
			'order' => 'Page.lft ASC',
			'recursive' => -1
		);
		
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
		
		$treeList = $this->Page->generateTreeList(null,null,null,'_',null);
		$treeNested = $this->Page->generateNestedList(null);
		$this->set(compact('treeList','treeNested'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__d('backend','Invalid page'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__d('backend','The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data = $this->Page->data;
				$this->Session->setFlash(__d('backend','The page could not be saved. Please, try again.'));
			}
		}
		$layoutViews = $this->Page->LayoutView->find('list');
		$parentPages = $this->Page->ParentPage->find('list');
		$this->set(compact('layoutViews', 'parentPages'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__d('backend','Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__d('backend','The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('backend','The page could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Page->read(null, $id);
		}
		$layoutViews = $this->Page->LayoutView->find('list');
		$parentPages = $this->Page->ParentPage->find('list');
		$this->set(compact('layoutViews', 'parentPages'));
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__d('backend','Invalid page'));
		}
		if ($this->Page->delete()) {
			$this->Session->setFlash(__d('backend','Page deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('backend','Page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
