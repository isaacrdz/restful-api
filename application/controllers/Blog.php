<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
  public function index(){
    echo 'Hello world';
  }

  public function comentarios($id){

    if( !is_numeric($id) ){
      $respuesta = array('err' => true, 'mensaje'=> 'El id tiene que ser numerico' );
      echo json_encode($respuesta);
      return;
    }

    $comentarios = array(
      array('id' => 1, 'mensaje' => 'lorem1' ),
      array('id' => 2, 'mensaje' => 'lorem2' ),
      array('id' => 3, 'mensaje' => 'lorem3' )
    );

    if($id >= count($comentarios) OR $id < 0) {
      $respuesta = array('err' => true, 'mensaje'=> 'El ID no existe' );
      echo json_encode($respuesta);
      return;
    }



    echo json_encode($comentarios[$id]);
  }
}
