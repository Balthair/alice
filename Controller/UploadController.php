<?php

class UploadController extends AppController
{

    public $upload_dir;
    public $tmp_name;
    public $verifyToken;
    public $target_File;
    public $fileParts;
    public $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'JPG');
    public $table_name;
    public $img_exist;
    public $img_root;
    public $UserId;
    public $multi;

    public $uses = array('News', 'Images', 'Tables');

    public $components = array(
        'Session',
        'Auth',
        'Image'
    );

    public function beforeFilter()
    {

        parent::beforeFilter();

        $user = $this->Session->read('Auth');

        $this->UserId = $user['User']['id'];

        $this->img_root = Configure::read('img_root');

        if (isset($_POST['token']))
            $this->set_verifyToken($_POST['token']);

        if (isset($_GET['seccion'])) {
            $seccion = $_GET['seccion'];
            $table = base64_decode($seccion);
            $this->set_table_name($table);
            /*esta es la ruta absoluta donde se sube la imagen cambia segun el framework o segun sea donde lo queremos guardar*/
            $targetFolder = Configure::read('absolute_root') . $table . '/';

            $this->set_upload_dir($targetFolder);
        }

        if (isset($_GET['img']) and $_GET['img'] != '') {

            $img = $_GET['img'];
            $this->set_img_exist($img);

        }

        if (isset($_GET['multi']) and $_GET['multi'] != '') {
            $multi = $_GET['multi'];
            $this->set_multi($multi);
        }

    }

    public function Upload_File()
    {
        $this->autoRender = false;
        //echo $this->verifyToken;

        if (!empty($_FILES) && $_POST['token'] == $this->verifyToken) {

            //tomamos el nombre de la base de datos
            $table_name = $this->table_name;

            $this->set_fileParts(pathinfo($_FILES['Filedata']['name']));

            $fileParts = $this->fileParts;

            //$user_session = $user['User']['id'];

            if ($this->img_exist == "") {

                //tomamos el id de quien lo subio para tener control en la subida            
                $data = array(
                    'id' => '',
                    'user_id' => $this->UserId
                );

                $this->Tables->useTable = $this->table_name;

                //Creamos el registro en la tabla que corresponda
                $this->Tables->add($data);

                //recuperamos el registro recien creado
                //$registro = $this->Tables->find('first');
                $registro = $this->Tables->getLastInsertId();

                $data = array(
                    'seccion' => $table_name,
                    'seccion_id' => $registro,
                    'extension' => $fileParts['extension']
                );

                //creamos el registro de la imagen
                $this->Images->save($data);

                //recuperamos el registro recien creado en las imagenes para luego usar los datos para cambiar el nombre
                $registro = $this->Images->getLastInsertId();

                //Establecemos el directorio donde va la imagen y cambiamos el nombre de la imagen por uno formado por los datos del registro       
                //$new_name = $registro.'.'.$fileParts['extension'];

            } else {

                $registro = $this->Images->find(
                    'first',
                    array(
                        'conditions' => array(
                            'seccion' => $this->table_name,
                            'seccion_id' => $this->img_exist
                        )
                    )
                );

                if (empty($registro) or $registro == "" or $registro == FALSE or $this->multi == true) {


                    $data = array(
                        'seccion' => $table_name,
                        'seccion_id' => $this->img_exist,
                        'extension' => $fileParts['extension']
                    );

                    $this->Images->save($data);

                    $registro = $this->Images->getLastInsertId();

                } else {

                    $registro = $registro['Images']['id'];

                    $this->Images->id = $registro;

                    $data = array(
                        'extension' => $fileParts['extension']
                    );

                    $this->Images->save($data);

                }

            }

            $new_name = $registro . '.' . $fileParts['extension'];

            $this->set_tmp_name($_FILES['Filedata']['tmp_name']);

            $this->set_target_file($this->upload_dir . $new_name);

            if (in_array(strtolower($fileParts['extension']), $this->fileTypes)) {

                // Save the file
                move_uploaded_file($this->tmp_name, $this->target_File);

                $I = $this->Image->imagen(Configure::read('absolute_root') . $table_name . '/' . $new_name);
                $this->Image->resize(40);
                $this->Image->saveTo(Configure::read('absolute_root') . $table_name . '/thumbs/' . $registro);


                echo "<div class='pic_wrapper' id='" . $registro . "'>";
                echo "<img src='" . $this->img_root . $table_name . '/' . $new_name . "' alt='' class='pic'>";
                echo "<a href='" . Router::url('/upload/delete_imagen/' . $registro) . "' class='delete drop icon_control' data='" . $registro . "'></a>";
                echo "</div>";
                echo "<script type='text/javascript'>$(document).ready(function(){
                    $('.drop').delete_img();  
                })</script>";
                //exit();

            } else {

                // The file type wasn't allowed
                echo 'Invalid file type.';

            }

        }

    }

    public function check_exists()
    {
        $this->autoRender = false;
        $targetFolder = $this->upload_dir; // Relative to the root and should match the upload folder in the uploader script

        if (file_exists($targetFolder . '/' . $_POST['filename'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete_imagen($id = null)
    {

        $this->autoRender = false;
        $reg = $this->Images->findById($id);

        $this->Images->id = $id;

        if ($this->Images->exists()) {

            if ($this->Images->delete()) {

                $src = Configure::read('absolute_root') . $reg['Images']['seccion'] . '/' . $reg['Images']['id'] . '.' . $reg['Images']['extension'];

                if (file_exists($src)) {
                    unlink($src);
                }

            }

        }
        //exit(1);

    }

    public function set_upload_dir($upload_dir)
    {
        $this->upload_dir = $upload_dir;
    }

    public function set_tmp_name($tmp_name)
    {
        $this->tmp_name = $tmp_name;
    }

    public function set_verifyToken($verifyToken)
    {
        $this->verifyToken = $verifyToken;
    }

    public function set_fileParts($fileParts)
    {
        $this->fileParts = $fileParts;
    }

    public function set_target_file($target_File)
    {
        $this->target_File = $target_File;
    }

    public function set_table_name($table_name)
    {
        $this->table_name = $table_name;
    }

    public function set_img_exist($img_exist)
    {
        $this->img_exist = $img_exist;
    }

    public function set_multi($multi)
    {
        $this->multi = $multi;
    }

}


