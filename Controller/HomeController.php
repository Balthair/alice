<?php 

/**
* 
*/
class HomeController extends AppController {
	
	public function index() {
		
		

	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index'); // Letting users register themselves
    }

}

?>