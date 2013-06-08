<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class ComoFunciona extends CI_Controller {
    function _construct() {
        parent::_construct();
    }

    public function index() {
        $data['titulo'] = "Como Funciona";
	$data['activo'] = 3;
       $data['contenido'] = 'estandar/inicio';
        $data['title'] = 'Trueque Inicio';
        $data['sidebar'] = 'sidebarCategorias';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            if ($usuarioActual['usuario_nivel'] == 0) {
                $data['menu'] = 'menuAdministrador';
            }
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
        }
         $this->load->view('plantilla', $data);
    }
}
?>
