<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require( APPPATH.'/libraries/REST_Controller.php');
// use Restserver\Libraries\REST_Controller;

class Clientes extends REST_Controller {

  public function __construct(){
    //Llamado del constructor padre
    parent::__construct();

    $this->load->database();
    // $this->load->helper('utilidades');

    $this->load->model('Cliente_model');
  }


public function paginar_get(){

  $this->load->helper('paginacion');

  $pagina     = $this->uri-> segment(3);
  $por_pagina = $this->uri-> segment(4);

  $campos  = array('id', 'nombre', 'telefono1');

  $respuesta = paginar_todo('clientes', $pagina, $por_pagina, $campos);

  $this->response( $respuesta );

}






  public function cliente_put(){

    $data = $this->put();

    $this->load->library('form_validation');

    $this->form_validation->set_data($data);

    // $this->form_validation->set_rules('correo','correo electronico','required|valid_email');
    // $this->form_validation->set_rules('nombre','nombre','required|min_length[2]');

    //TRUE :: Todo bien False :: Falla una regla
    if( $this->form_validation->run('cliente_put') ){
      //Todo bien
      $this->response('Todo bien');

    } else {
      //Algo mal
      // $this->response('Todo mal');
      $respuesta = array(
              'err' => TRUE,
              'mensaje' => 'Hay errores en el envio de informacion',
              'errores' => $this->form_validation->get_errores_arreglo()
             );


      $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);

    }

    // $this-> response($data);
  }

















  public function cliente_get(){

    $cliente_id = $this->uri-> segment(3);

    if(!isset($cliente_id)){
      $respuesta = array(
          'err' => TRUE ,
          'mensaje' => 'Es necesario el ID del cliente'
          );
          $this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );

          return;
    }

    $cliente = $this->Cliente_model->get_cliente($cliente_id);

    if(isset($cliente)){
      $respuesta = array(
          'err' => FALSE ,
          'mensaje' => 'Registro cargado correctamente',
          'cliente' => $cliente
        );

        $this->response($respuesta);
    } else {
      $respuesta = array(
          'err' => TRUE ,
          'mensaje' => 'El registro con el id '.$cliente_id.', no existe.',
          'cliente' => null
        );
        $this->response( $respuesta,REST_Controller::HTTP_NOT_FOUND );
    }

  }
}
