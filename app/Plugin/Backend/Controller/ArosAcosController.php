<?php
App::uses('BackendAppController', 'Backend.Controller');
/**
 * ArosAcos Controller
 *
 * @property ArosAco $ArosAco
 */
class ArosAcosController extends BackendAppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ArosAco->recursive = 0;
		$this->set('arosAcos', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ArosAco->exists($id)) {
			throw new NotFoundException(__('Invalid %s',__('aros aco')));
		}
		$options = array('conditions' => array('ArosAco.' . $this->ArosAco->primaryKey => $id));
		$this->set('arosAco', $this->ArosAco->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ArosAco->create();
			if ($this->ArosAco->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved',__('aros aco')),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',__('aros aco')),'error');
			}
		}
		$aros = $this->ArosAco->Aro->find('list');
		$acos = $this->ArosAco->Aco->find('list');
		$this->set(compact('aros', 'acos'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ArosAco->exists($id)) {
			throw new NotFoundException(__('Invalid %s',__('aros aco')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ArosAco->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved',__('aros aco')),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',__('aros aco')),'error');
			}
		} else {
			$options = array('conditions' => array('ArosAco.' . $this->ArosAco->primaryKey => $id));
			$this->request->data = $this->ArosAco->find('first', $options);
		}
		$aros = $this->ArosAco->Aro->find('list');
		$acos = $this->ArosAco->Aco->find('list');
		$this->set(compact('aros', 'acos'));
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
		$this->ArosAco->id = $id;
		if (!$this->ArosAco->exists()) {
			throw new NotFoundException(__('Invalid %s',__('aros aco')));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ArosAco->delete()) {
			$this->Session->setFlash(__('%s deleted',__('Aros aco')),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('%s was not deleted',__('Aros aco')),'error');
		$this->redirect(array('action' => 'index'));
	}
}
