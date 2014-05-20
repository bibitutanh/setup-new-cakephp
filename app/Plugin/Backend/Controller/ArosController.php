<?php
App::uses('BackendAppController', 'Backend.Controller');
/**
 * Aros Controller
 *
 * @property Aro $Aro
 */
class ArosController extends BackendAppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Aro->recursive = 0;
		$this->set('aros', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Aro->exists($id)) {
			throw new NotFoundException(__('Invalid %s',__('aro')));
		}
		$options = array('conditions' => array('Aro.' . $this->Aro->primaryKey => $id));
		$this->set('aro', $this->Aro->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Aro->create();
			if ($this->Aro->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved',__('aro')),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',__('aro')),'error');
			}
		}
		$parents = $this->Aro->find('list');
		$this->set(compact('parents'));
		//$acos = $this->Aro->Aco->find('list');
		//$this->set(compact('acos'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Aro->exists($id)) {
			throw new NotFoundException(__('Invalid %s',__('aro')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Aro->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved',__('aro')),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',__('aro')),'error');
			}
		} else {
			$options = array('conditions' => array('Aro.' . $this->Aro->primaryKey => $id));
			$this->request->data = $this->Aro->find('first', $options);
		}
		$acos = $this->Aro->Aco->find('list');
		$this->set(compact('acos'));
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
		$this->Aro->id = $id;
		if (!$this->Aro->exists()) {
			throw new NotFoundException(__('Invalid %s',__('aro')));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Aro->delete()) {
			$this->Session->setFlash(__('%s deleted',__('Aro')),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('%s was not deleted',__('Aro')),'error');
		$this->redirect(array('action' => 'index'));
	}
}
