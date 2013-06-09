<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permutas extends CI_Controller {

    function Permutas() {
        parent::__construct();
        $this->load->model('permutaModel');
    }

    public function index() {
        $data['contenido'] = 'usuario/propuestasRecibidas';
        $data['title'] = 'Propuestas Recibidas';
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
        $this->load->library('pagination');
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'permutas/index';
        $opciones['total_rows'] = $this->permutaModel->getNumPermutas($current);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $permutas= $this->permutaModel->getPermutas($current,$opciones['per_page'], $this->uri->segment(3));
        $data['permutas'] = $permutas;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
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
    function permutasEnviadas(){
        $data['contenido'] = 'usuario/propuestasEnviadas';
        $data['title'] = 'Propuestas Enviadas';
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
        $this->load->library('pagination');
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'permutas/permutasEnviadas';
        $opciones['total_rows'] = $this->permutaModel->getNumPermutasEnviadas($current);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $permutas= $this->permutaModel->getPermutasEnviadas($current,$opciones['per_page'], $this->uri->segment(3));
        $data['permutas'] = $permutas;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
        $this->load->view('plantilla', $data);
    }
}