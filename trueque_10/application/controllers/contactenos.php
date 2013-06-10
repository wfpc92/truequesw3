<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Contactenos extends CI_Controller {
    function _construct() {
        parent::_construct();
    }

    public function index() {
        $data['titulo'] = "Contactenos";
	$data['activo'] = 4;
        $data['contenido'] = 'estandar/contactanos';
        $data['title'] = 'Trueque Inicio';
        $data['sidebar'] = 'sidebarContactenos';
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
