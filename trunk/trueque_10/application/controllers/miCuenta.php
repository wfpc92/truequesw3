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

    function guardarProducto() {
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/publicarProducto';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['categoria'] = $this->productoModel->cargarCategoria();
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'nombre',
                        'label' => 'nombre',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'categoria',
                        'label' => 'categoria',
                        'rules' => 'trim|callback_seleccionar'
                    ),
                    array(
                        'field' => 'descripcion',
                        'label' => 'descripcion',
                        'rules' => 'trim|required'
                    )
                );
                $this->load->library('form_validation');
                $this->form_validation->set_rules($config);
                $this->form_validation->set_message('required', 'El campo %s es requerido');

                if ($this->form_validation->run() == FALSE) {
                    $data['errores'] = validation_errors();
                } else {

                    $fechaActual = date("y-m-d");
                    $producto = array(
                        'nombre' => $_POST['nombre'],
                        'descripcion' => $_POST['descripcion'],
                        'categoria_id' => $_POST['categoria'],
                        'fechaingreso' => $fechaActual,
                        'usuario_id' => $usuarioActual['usuario_id']
                    );
                    $data['producto'] = $producto;
                    $data['contenido'] = 'usuario/publicarImagen';
                }
            }
            $this->load->view("plantilla", $data);
        } else {
            redirect(base_url());
        }
    }

    function guardarImagen() {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '800';
        $config['max_height'] = '600';
        $producto = $_POST['producto'];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('usuario/publicarImagen', $error);
        } else {
            $this->load->model('productoModel');
            $data = array('upload_data' => $this->upload->data());
            $aux = $this->upload->data();
            $producto['imagen'] = base_url().'/images/'.$aux['file_name'];
            echo $producto['imagen'];
            $this->productoModel->agregarProducto($producto);
            redirect('miCuenta');
        }
        echo $producto['nombre'];
        echo $producto['descripcion'];
        echo $producto['fechaingreso'];
        echo $producto['usuario_id'];
    }

    public function hacerTrueque() {
        
    }

    function seleccionar($str) {
        if ($str == "") {
            $this->form_validation->set_message('seleccionar', 'El campo %s No se ha seleccionado');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function editarProducto($id){
        
    }

}

?>