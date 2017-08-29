<?php

function capitalizar_todo($data_cruda){
  
  return capitalizar_arreglo($data_cruda, array(), TRUE);

}


function capitalizar_arreglo($data_cruda, $campos_capitalizar = array(), $todos = FALSE){


  $data_lista = $data_cruda;

  foreach ($data_cruda as $nombre_campo => $valor_campo) {
    if (in_array ($nombre_campo, array_values($campos_capitalizar)) OR $todos){
      $data_lista[$nombre_campo] = strtoupper($valor_campo);
    }
  }
  return $data_lista;
}



function obtener_mes($mes){

  if( !is_numeric($mes) ){
    $respuesta = array('err' => true, 'mensaje'=> 'El mes tiene que ser numerico' );
    echo json_encode($respuesta);
    return;
  }


  $mes -= 1;

  $meses = array(
    'enero',
    'febrero',
    'marzo',
    'abril',
    'mayo',
    'junio',
    'julio',
    'agosto',
    'septiembre',
    'octubre',
    'noviembre',
    'diciembre'
  );
  if($mes >= count($meses) OR $mes < 0) {
    $respuesta = array('err' => true, 'mensaje'=> 'El Mes no existe' );
    echo json_encode($respuesta);
    return;
  }



  return $meses[$mes];
}



 ?>
