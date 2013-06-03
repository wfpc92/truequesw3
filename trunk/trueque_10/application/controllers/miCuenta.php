<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class MiCuenta extends CI_Controller {

    function _construct() {
        parent::_construct();
    }

    public function index() {
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Trueque Mi Cuenta';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/misProductos';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id']);
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function truequear($idProdTrueque) {
        $this->load->model('productoModel');
        $data['title'] = 'Trueque Truequear';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'misProductosSeleccionar';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarCategorias';
            $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id']);
            $data['idProdTrueque'] = $idProdTrueque;
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
            $data['contenido'] = 'contenido';
            $data['sidebar'] = 'sidebarCategorias';
        }

        $this->load->view('plantilla', $data);
    }

    public function publicarProducto() {
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/publicarProducto';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }
    
    public function hacerTrueque() {
        
    }
}

?>