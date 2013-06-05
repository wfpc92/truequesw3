<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Permutas extends CI_Controller {

    function Permutas() {
        parent::__construct();
        $this->load->model('permutaModel');
    }

    public function index() {
        $data['contenido'] = 'usuario/propuestasRecibidas';
        $data['title'] = 'Ver Permutas';
        $data['sidebar'] = 'sidebarMiCuenta';
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
        $current= $usuarioActual['usuario_id'];
        $data['permutas'] = $this->permutaModel->getPermutas($current);
        $this->load->view('plantilla', $data);
    }
    
    function permutar($peticion){
        $this->permutaModel->hacerPermuta($peticion);
        redirect('permutas');
        
    }
    
    function rechazar($peticion){
        $this->permutaModel->rechazarPermuta($peticion);
        redirect('permutas');
        
    }
}