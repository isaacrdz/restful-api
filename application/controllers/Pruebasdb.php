<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pruebasdb extends CI_Controller{

  public function __construct(){
    //Llamado del constructor padre
    parent::__construct();

    $this->load->database();
    $this->load->helper('utilidades');

  }
public function eliminar(){
  $this->db->where('id', 8);
  $this->db->delete('test');

  echo "Registro eliminado";
}


  public function actualizar(){
    $data = array(
        'nombre' => 'pedro',
        'apellido' => 'ramirez'
    );

    $data = capitalizar_todo($data);


    $this->db->where('id', 8 );
    $this->db->update('test', $data);

    echo " Todo bien ";
  }

  public function insertar(){


    $data = array(
        'nombre' => 'Panfilo ',
        'apellido' => 'Leos'
    );

    $data = capitalizar_todo($data);

    $this->db->insert('test', $data);

    $respuesta = array(
      'err'=> FALSE,
      'id_insertado' => $this->db->insert_id()
    );

    echo json_encode($respuesta);

  }

  public function tabla(){

    $this->db->select('pais,count(*)');
    $this->db->from('clientes');

    $this->db->group_by("pais");

    $query = $this->db->get();

    echo json_encode($query->result());
  }





  public function clientes_beta(){
    // $this->load->database();

    $query = $this->db->query('SELECT id, nombre, correo FROM clientes limit 10');

    // foreach ($query->result() as $row)
    // {
    //         echo $row->id;
    //         echo $row->nombre;
    //         echo $row->correo;
    // }
    //
    // echo 'Total Results: ' . $query->num_rows();

    $respuesta = array(
          'err' => FALSE,
          'mensaje' => 'Registros cargados correctamente',
          'total_registros' => $query->num_rows(),
          'clientes' => $query->result()
        );

        echo json_encode($respuesta);

  }

  public function cliente($id){
    // $this->load->database();
    $query = $this->db->query('SELECT * FROM clientes WHERE id = '. $id);
    $row = $query->row();

    if(isset($row)){
      $respuesta = array(
            'err' => FALSE,
            'mensaje' => 'Registros cargado correctamente',
            'total_registros' => 1,
            'clientes' => $row
          );
    }else {
      //Fila no existe
      $respuesta = array(
            'err' => TRUE,
            'mensaje' => 'El registro con el id '. $id .', no existe',
            'total_registros' => 0,
            'clientes' => null
          );
    }
    echo json_encode($respuesta);


  }
}
