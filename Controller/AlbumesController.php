<?php
App::uses('AppController', 'Controller');

App::uses('CakeTime', 'Utility');
/**
 * Albumes Controller
 *
 * @property Albume $Albume
 */
class AlbumesController extends AppController {

	public $components = array('Funciones');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Albume->recursive = 0;
		$this->paginate = array('order' => array('Albume.id' => 'DESC'));
		$this->set('albumes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Albume->exists($id)) {
			throw new NotFoundException(__('Album Invalido'));
		}
		$options = array('conditions' => array('Albume.' . $this->Albume->primaryKey => $id));
		$this->set('albume', $this->Albume->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Albume->create();
			$this->request->data['Albume']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Albume']['nombre']);
			$this->request->data['Albume']['fecha_publicacion'] = CakeTime::format('Y-m-d 00:00:00', time());
			if ($this->Albume->save($this->request->data)) {
				$this->Session->setFlash(__('The albume has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The albume could not be saved. Please, try again.'));
			}
		}
		$photographers = $this->Albume->Photographer->find('list');
		$this->set(compact('photographers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Albume->exists($id)) {
			throw new NotFoundException(__('Invalid albume'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Albume']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Albume']['nombre']);
			if ($this->Albume->save($this->request->data)) {
				$this->Session->setFlash(__('The albume has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The albume could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Albume.' . $this->Albume->primaryKey => $id));
			$this->request->data = $this->Albume->find('first', $options);
		}
		$photographers = $this->Albume->Photographer->find('list');
		$this->set(compact('photographers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Albume->id = $id;
		if (!$this->Albume->exists()) {
			throw new NotFoundException(__('Invalid albume'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Albume->delete()) {
			$this->Session->setFlash(__('Albume deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Albume was not deleted'));
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
