<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Administrar extends CI_Controller {

    function _construct() {
        parent::_construct();
    }

    public function index() {
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $data['title'] = 'Trueque Mi Cuenta';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'adminUsuarios';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['usuarios'] = $this->usuariosModel->getUsuarios();
            if ($usuarioActual['usuario_nivel'] == 0) {
                $data['menu'] = 'menuAdministrador';
                $data['sidebar'] = 'sidebarAdministrar';
            }
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
            $data['contenido'] = 'contenido';
            $data['sidebar'] = 'sidebarCategorias';
        }

        $this->load->view('plantilla', $data);
    }

    public function updateUsuario($id) {
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $data['title'] = 'Editar Usuario';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'editarUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['usuarios'] = $this->usuariosModel->getUsuarios();
            if ($usuarioActual['usuario_nivel'] == 0) {
                $data['menu'] = 'menuAdministrador';
                $data['sidebar'] = 'sidebarAdministrar';
            }
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
            $data['contenido'] = 'contenido';
            $data['sidebar'] = 'sidebarCategorias';
        }
        $data['usuario'] = $this->usuariosModel->getUsuario($id);
        $data['ciudades'] = $this->productoModel->cargarCiudad();
        $this->load->view('plantilla', $data);
    }
    public function guardarUsuario(){
          $this->load->model('usuariosModel');
        $this->load->model('productoModel');
		$usuarioInfo=$this->input->post('usuario');
		$ciudad=$this->input->post('ciudad');
		$this->usuariosModel->setUsuario($usuarioInfo,$ciudad);
		redirect('a');
	}
}