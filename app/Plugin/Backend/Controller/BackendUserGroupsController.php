<?php
App::uses('BackendAppController', 'Backend.Controller');
/**
 * BackendUserGroups Controller
 *
 * @property BackendUserGroup $BackendUserGroup
 */
class BackendUserGroupsController extends BackendAppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->BackendUserGroup->recursive = 0;
		$this->set('backendUserGroups', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->BackendUserGroup->exists($id)) {
			throw new NotFoundException(__('Invalid %s',__('backend user group')));
		}
		$options = array('conditions' => array('BackendUserGroup.' . $this->BackendUserGroup->primaryKey => $id));
		$this->set('backendUserGroup', $this->BackendUserGroup->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BackendUserGroup->create();
			if ($this->BackendUserGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved',__('backend user group')),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',__('backend user group')),'error');
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->BackendUserGroup->exists($id)) {
			throw new NotFoundException(__('Invalid %s',__('backend user group')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BackendUserGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved',__('backend user group')),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',__('backend user group')),'error');
			}
		} else {
			$options = array('conditions' => array('BackendUserGroup.' . $this->BackendUserGroup->primaryKey => $id));
			$this->request->data = $this->BackendUserGroup->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->BackendUserGroup->id = $id;
		if (!$this->BackendUserGroup->exists()) {
			throw new NotFoundException(__('Invalid %s',__('backend user group')));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BackendUserGroup->delete()) {
			$this->Session->setFlash(__('%s deleted',__('Backend user group')),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('%s was not deleted',__('Backend user group')),'error');
		$this->redirect(array('action' => 'index'));
	}
}
