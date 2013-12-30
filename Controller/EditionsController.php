<?php
App::uses('AppController', 'Controller');


App::uses('CakeTime', 'Utility');

/**
 * Editions Controller
 *
 * @property Edition $Edition
 */
class EditionsController extends AppController {

	public $components = array('Funciones');
	//public $uses = array('Article', 'Edition');
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Edition->recursive = 0;
		$this->paginate = array('order' => array('Edition.id' => 'DESC'),'conditions'=>array('Edition.user_id'=>$this->Auth->user('id'),'nombre !='=>''));
		$this->set('editions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Edition->exists($id)) {
			throw new NotFoundException(__('Invalid edition'));
		}
		$options = array('conditions' => array('Edition.' . $this->Edition->primaryKey => $id));
		$this->set('edition', $this->Edition->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Edition->create();
			$this->request->data['Edition']['permalink'] = $this->Funciones->generatePermalink($this->request->data['Edition']['nombre']);
			$this->request->data['Edition']['created'] = CakeTime::format('Y-m-d h:i:00', time());
			$this->request->data['Edition']['user_id'] = $this->Auth->user('id');
			$this->Edition->id = @$this->Edition->find(
				'first',
				array(
					'conditions'=>array('Edition.user_id'=>$this->Auth->user('id'),'nombre'=>''),
					'fields' => 'Edition.id'
				)
			);
			if ($this->Edition->save($this->request->data)) {
				$this->Session->setFlash(__('La edición se guardo correctamente'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La edición no pudo ser guardada, Favor Intente de Nuevo'));
			}
		} else {
			$this->Edition->deleteAll(
	    		array(
	    			'nombre' => '',
					'user_id' => $this->Auth->user('id')
	    		)
	    	);
		}
		$users = $this->Edition->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {

		if (!$this->Edition->exists($id)) {
			throw new NotFoundException(__('Invalid edition'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Edition']['created'] = CakeTime::format('Y-m-d h:i:00', time());
			if ($this->Edition->save($this->request->data)) {
				$this->Session->setFlash(__('The edition has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The edition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Edition.' . $this->Edition->primaryKey => $id));
			$this->request->data = $this->Edition->find('first', $options);
		}
		$users = $this->Edition->User->find('list');
		$this->set(compact('users'));
	}

	/*public function isAuthorized($user) {
	    // Admin can access every action
	    if ($this->Edition->isOwnedBy(1, 1)) {
	    die('ola');
            return true;
        }
        die('juaz');
	    // Default deny
	    return false;
	}*/
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Edition->id = $id;
		if (!$this->Edition->exists()) {
			throw new NotFoundException(__('Invalid edition'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Edition->delete()) {
			$this->loadModel('Image');
			$this->Image->deleteAll(
	    		array(
	    			'seccion' => 'Editions',
					'seccion_id' => $id
	    		)
	    	);
			$this->Session->setFlash(__('Edition deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Edition was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/*public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}*/

	public function index()	{
		
	}

	public function viewAll() {

		$this->loadModel('Article');
		$this->loadModel('Ad');

		$lastEdition = $this->Edition->find(
			'first',
			array(
				'order' => array(
					'Edition.created' => 'DESC',
					'Edition.id' => 'DESC'
				)
			)
		);

		if (!empty($lastEdition)) {
			
			$articles = $this->Article->find(
				'all',
				array(
					'conditions' => array(
						'Article.edition_id' => $lastEdition['Edition']['id'],
						'Article.estado' => 1
					),
					'order' => array(
						'Article.relevancia_id' => 'ASC',
						'Article.created' => 'DESC',
						'Article.id' => 'DESC'
					)
				)
			);

			$this->paginate = array(
				'order' => array(
					'Edition.created' => 'DESC',
					'Edition.id' => 'DESC'
				),
				'limit' => 8
			);
			
			$editions = $this->paginate(
				'Edition',
				array(
					'Edition.id !=' => $lastEdition['Edition']['id']
				)
			);

		}

		$pubEdiH = $this->Ad->find(
			'first',
			array(
				'conditions' => array(
					'Ad.orientacion' => 'horizontal',
					'Ad.bloque' => 'ediciones'
				),
				'order' => array(
					'Ad.id' => 'DESC'
				)
			)
		);


		$this->set(
			array(
				'title_for_layout' => 'Ediciones',
				'title_for_section' => 'Ediciones',
				'lastEdition' => @$lastEdition,
				'articles' => @$articles,
				'editions' => @$editions,
				'pubEdiH' => @$pubEdiH
			)
		);

	}

	public function view() {

		$this->loadModel('Article');
		$this->loadModel('Ad');

		if (!empty($this->passedArgs['title']) and isset($this->passedArgs['title'])) {

			$permalink = explode('-', $this->passedArgs['title']);

			$id = $permalink[0];

			$edition = $this->Edition->find(
				'first',
				array(
					'conditions' => array(
						'Edition.id' => $id
					)
				)
			);

			if (!empty($edition)) {

				$articlePrinc = $this->Article->find(
					'first',
					array(
						'conditions' => array(
							'Article.estado' => 1,
							'Article.edition_id' => $id,
							'Article.relevancia_id' => 1,
						),
						'order' => array(
							'Article.created' => 'DESC',
							'Article.id' => 'DESC'
						)
					)
				);

				if (!empty($articlePrinc)) {
					$articlesSec = $this->Article->find(
						'all',
						array(
							'conditions' => array(
								'Article.estado' => 1,
								'Article.edition_id' => $id,
								'Article.id !=' => $articlePrinc['Article']['id'],
							),
							'order' => array(
								'Article.created' => 'DESC',
								'Article.id' => 'DESC'
							)
						)
					);
				}

				$lastEditions = $this->Edition->find(
					'all',
					array(
						'conditions' => array(
							'Edition.id !=' => $edition['Edition']['id']
						),
						'order' => array(
							'Edition.created' => 'DESC',
							'Edition.id' => 'DESC'
						),
						'limit' => 4
					)
				);

				$pubEdiH = $this->Ad->find(
					'first',
					array(
						'conditions' => array(
							'Ad.orientacion' => 'horizontal',
							'Ad.bloque' => 'ediciones'
						),
						'order' => array(
							'Ad.id' => 'DESC'
						)
					)
				);

				$pubArtV = $this->Ad->find(
					'all',
					array(
						'conditions' => array(
							'Ad.orientacion' => 'vertical',
							'Ad.bloque' => 'articulos'
						),
						'order' => array(
							'Ad.id' => 'DESC'
						),
						'limit' => 2
					)
				);

				$this->set(
					array(
						'title_for_layout' => @$edition['Edition']['nombre'],
						'title_for_section' => @$edition['Edition']['nombre'],
						'edition' => @$edition,
						'articlePrinc' => @$articlePrinc,
						'articlesSec' => @$articlesSec,
						'lastEditions' => @$lastEditions,
						'pubEdiH' => @$pubEdiH,
						'pubArtV' => @$pubArtV
					)
				);
				
			} else {
				$this->set(
					array(
						'title_for_layout' => 'Error 404',
						'title_for_section' => 'Error 404'
					)
				);
			}
		} else {
			$this->set(
				array(
					'title_for_layout' => 'Error 404',
					'title_for_section' => 'Error 404'
				)
			);
		}

	}

	public function beforeFilter() {
        parent::beforeFilter();
         if ($this->params['admin'] == 1) {
        	$this->layout = 'admin';
        } else {
        	$this->layout = 'into';
        }
        $this->Auth->allow('index', 'viewAll', 'view'); // Letting users register themselves
    }

}
