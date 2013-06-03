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
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $data['title'] = 'Crud Usuarios';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/adminUsuarios';
            $data['usuarioActual'] = $usuarioActual;
            $data['usuarios'] = $this->usuariosModel->getUsuarios();
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function updateUsuario($id) {
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $data['title'] = 'Editar Usuario';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/editarUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $data['usuario'] = $this->usuariosModel->getUsuario($id);
            $data['ciudades'] = $this->productoModel->cargarCiudad();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function guardarUsuario() {
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioInfo = $this->input->post('usuario');
        $usuarioInfo['id_ciudad'] = $this->input->post('ciudad');
        $this->usuariosModel->setUsuario($usuarioInfo);
        redirect('administrar');
    }

    public function deleteUsuario($id) {
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $data['title'] = 'Eliminar Usuario';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/borrarUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $data['usuario'] = $this->usuariosModel->getUsuario($id);
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function borrarUsuario() {
        $this->load->model('usuariosModel');
        $id = $this->input->post('id');
        $this->usuariosModel->borrarUsuario($id);
        redirect('administrar');
    }

}