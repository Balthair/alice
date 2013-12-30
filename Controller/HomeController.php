<?php 
App::uses('AppController', 'Controller');

/**
* 
*/
class HomeController extends AppController {

	public $uses = array('Edition', 'Article', 'Ad', 'Albume');

	public $components = array('Funciones', 'Image');
	
	public function index() {
		
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

			$lastArticles = $this->Article->find(
				'all',
				array(
					'conditions' => array(
						'Article.edition_id' => @$lastEdition['Edition']['id'],
						'Article.estado' => 1,
						'Article.categoria_id !=' => 6 
					),
					'order' => array(
						'Article.relevancia_id' => 'ASC',
						'Article.created' => 'DESC',
						'Article.id' => 'DESC'
					)
				)
			);

			$lastEditions = $this->Edition->find(
				'all',
				array(
					'conditions' => array(
						'Edition.id !=' => $lastEdition['Edition']['id']
					),
					'order' => array(
						'Edition.created' => 'DESC',
						'Edition.id' => 'DESC'
					),
					'limit' => 3
				)
			);

		}

		$pubArtH = $this->Ad->find(
			'first',
			array(
				'conditions' => array(
					'Ad.orientacion' => 'horizontal',
					'Ad.bloque' => 'articulos'
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

		$Albumes = $this->Albume->find(
			'all',
			array(
				'order' => array(
					'Albume.fecha_publicacion' => 'DESC',
					'Albume.id' => 'DESC'
				),
				'limit' => 6
			)
		);

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

		$pubHome = $this->Ad->find(
			'all',
			array(
				'conditions' => array(
					'Ad.bloque' => 'portada'
				),
				'order' => array(
					'Ad.id' => 'DESC'
				)
			)
		);

		$this->set(
			array(
				'lastArticles' => @$lastArticles,
				'lastEditions' => @$lastEditions,
				'albumes' => @$Albumes,
				'pubArtH' => @$pubArtH,
				'pubArtV' => @$pubArtV,
				'pubEdiH' => @$pubEdiH,
				'pubAlbH' => @$pubAlbH,
				'pubAlbV' => @$pubAlbV,
				'pubHome' => @$pubHome,
				'title_for_layout' => 'Revista Alice'
			)
		);

	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index'); // Letting users register themselves
    }

}

?>