<?php
App::uses('AppController', 'Controller');
/**
 * Photographers Controller
 *
 * @property Photographer $Photographer
 */
class PhotographersController extends AppController {

	public $components = array('Funciones');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Photographer->recursive = 0;
		$this->paginate = array('order' => array('Photographer.id' => 'DESC'));
		$this->set('photographers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Photographer->exists($id)) {
			throw new NotFoundException(__('Invalid photographer'));
		}
		$options = array('conditions' => array('Photographer.' . $this->Photographer->primaryKey => $id));
		$this->set('photographer', $this->Photographer->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Photographer']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Photographer']['nombre']);
			$this->request->data['Photographer']['user_id'] = $this->Auth->user('id');
			$this->Photographer->create();
			if ($this->Photographer->save($this->request->data)) {
				$this->Session->setFlash(__('The photographer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photographer could not be saved. Please, try again.'));
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
		if (!$this->Photographer->exists($id)) {
			throw new NotFoundException(__('Invalid photographer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Photographer']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Photographer']['nombre']);
			if ($this->Photographer->save($this->request->data)) {
				$this->Session->setFlash(__('The photographer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photographer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Photographer.' . $this->Photographer->primaryKey => $id));
			$this->request->data = $this->Photographer->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Photographer->id = $id;
		if (!$this->Photographer->exists()) {
			throw new NotFoundException(__('Invalid photographer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Photographer->delete()) {
			$this->Session->setFlash(__('Photographer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Photographer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
        parent::beforeFilter();
        if ($this->params['admin'] == 1) {
        	$this->layout = 'admin';
        } else {
        	$this->layout = 'into';
        }
    }
}
