<?php
App::uses('AppController', 'Controller');
/**
 * Galery Controller
 *
 * @property Galery $Galery
 */
class GaleryController extends AppController {

	public function index() {
		$this->redirect('viewAll');
	}

	public function viewAll() {

		$this->loadModel('Albume');
		$this->loadModel('Ad');

		$galeryP = $this->Albume->find(
			'first',
			array(
				'order' => array(
					'Albume.fecha_publicacion' => 'DESC',
					'Albume.id' => 'DESC'
				)
			)
		);

		if (!empty($galeryP)) {

			$this->paginate = array(
				'order' => array(
					'Albume.fecha_publicacion' => 'DESC',
					'Albume.id' => 'DESC'
				),
				'limit' => 6
			);
			
			$galeries = $this->paginate(
				'Albume',
				array(
					'Albume.id !=' => $galeryP['Albume']['id']
				)
			);

			$pubAlbV = $this->Ad->find(
				'first',
				array(
					'conditions' => array(
						'Ad.orientacion' => 'vertical',
						'Ad.bloque' => 'galerias'
					),
					'order' => array(
						'Ad.id' => 'DESC'
					)
				)
			);

		}

		$pubAlbH = $this->Ad->find(
			'first',
			array(
				'conditions' => array(
					'Ad.orientacion' => 'horizontal',
					'Ad.bloque' => 'galerias'
				),
				'order' => array(
					'Ad.id' => 'DESC'
				)
			)
		);

		$this->set(
			array(
				'title_for_section' => 'Galerías',
				'title_for_layout' => 'Galerías',
				'galeryP' => @$galeryP,
				'galeries' => @$galeries,
				'pubAlbV' => @$pubAlbV,
				'pubAlbH' => @$pubAlbH
			)
		);

	}

	public function view() {

		$this->loadModel('Albume');
		$this->loadModel('Ad');

		if (!empty($this->passedArgs['title']) and isset($this->passedArgs['title'])) {

			$permalink = explode('-', $this->passedArgs['title']);

			$id = $permalink[0];

			$galery = $this->Albume->find(
				'first',
				array(
					'conditions' => array(
						'Albume.id' => $id
					)
				)
			);

			if (!empty($galery)) {
				
				$otherG = $this->Albume->find(
					'all',
					array(
						'conditions' => array(
							'Albume.id !=' => $galery['Albume']['id']
						),
						'order' => array(
							'Albume.fecha_publicacion' => 'DESC',
							'Albume.id' => 'DESC'
						),
						'limit' => 6
					)
				);

			}

		}

		$pubAlbH = $this->Ad->find(
			'first',
			array(
				'conditions' => array(
					'Ad.orientacion' => 'horizontal',
					'Ad.bloque' => 'galerias'
				),
				'order' => array(
					'Ad.id' => 'DESC'
				)
			)
		);

		$this->set(
			array(
				'title_for_section' => 'Galerías',
				'title_for_layout' => $galery['Albume']['nombre'],
				'galery' => @$galery,
				'otherG' => @$otherG,
				'pubAlbH' => @$pubAlbH
			)
		);
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
