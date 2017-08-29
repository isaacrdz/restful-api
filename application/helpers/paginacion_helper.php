<?php

function paginar_todo($tabla, $pagina = 1, $por_pagina = 20, $campos = array()){

  if(!isset($por_pagina)){
    $por_pagina = 20;
  }

  if(!isset($pagina)){
    $$pagina = 1;
  }

  $CI =& get_instance();
  $CI ->load->database();

  $cuantos       = $CI->db->count_all($tabla);
  $total_paginas = ceil($cuantos/ $por_pagina);

  if( $pagina > $total_paginas){
    $pagina = $total_paginas;
  }

  $pagina -= 1;
  $desde = $pagina * $por_pagina;

  if ($pagina >= $total_paginas - 1 ){
    $pag_siguiente = 1;
  } else {
    $pag_siguiente = $pagina + 2;
  }

  if($pagina < 1 ){
    $pag_anterior = $total_pagina;
  } else {
    $pag_anterior = $pagina;
  }
  $CI->db->select($campos);
  $query = $CI->db->get($tabla, $por_pagina, $desde);

  $respuesta = array(
          'err'             => FALSE,
          'cuantos'         => $cuantos,
          'total_paginas'   => $total_paginas,
          'pag_actual'      => ($pagina + 1),
          'pag_siguiente'   => $pag_siguiente,
          'pagina_anterior' => $pag_anterior,
          $tabla            => $query->result()
          );


  return $respuesta;


}
?>
