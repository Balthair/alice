<?php
App::uses('AppController', 'Controller');
/**
 * Editors Controller
 *
 * @property Editor $Editor
 */
class EditorsController extends AppController {

	public $components = array('Funciones');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Editor->recursive = 0;
		$this->paginate = array('order' => array('Editor.id' => 'DESC'));
		$this->set('editors', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Editor->exists($id)) {
			throw new NotFoundException(__('Invalid editor'));
		}
		$options = array('conditions' => array('Editor.' . $this->Editor->primaryKey => $id));
		$this->set('editor', $this->Editor->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Editor']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Editor']['nombre']);
			$this->request->data['Editor']['user_id'] = $this->Auth->user('id');
			$this->Editor->create();
			$this->Editor->id = @$this->Editor->find(
				'first',
				array(
					'conditions'=>array('Editor.user_id'=>$this->Auth->user('id'),'Editor.nombre'=>''),
					'fields' => 'Editor.id'
				)
			);
			if ($this->Editor->save($this->request->data)) {
				$this->Session->setFlash(__('The editor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The editor could not be saved. Please, try again.'));
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
		if (!$this->Editor->exists($id)) {
			throw new NotFoundException(__('Invalid editor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Editor']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Editor']['nombre']);
			if ($this->Editor->save($this->request->data)) {
				$this->Session->setFlash(__('The editor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The editor could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Editor.' . $this->Editor->primaryKey => $id));
			$this->request->data = $this->Editor->find('first', $options);
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
		$this->Editor->id = $id;
		if (!$this->Editor->exists()) {
			throw new NotFoundException(__('Invalid editor'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Editor->delete()) {
			$this->Session->setFlash(__('Editor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Editor was not deleted'));
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
