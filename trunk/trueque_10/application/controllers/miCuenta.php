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
        $this->load->library('pagination');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Trueque Mi Cuenta';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/misProductos';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            
            //PAGINACION...
            $opciones = array();
            $opciones['per_page'] = 5;
            $opciones['base_url'] = base_url().'miCuenta/index/';
            $opciones['total_rows'] = $this->productoModel->numMisProductos($usuarioActual['usuario_id']);;
            $opciones['uri_segment'] = 3;
            $opciones['num_links'] = 3;
            $opciones['first_link'] = 'Primero';
            $opciones['last_link'] = 'Ultimo';
            $this->pagination->initialize($opciones);
            $data['paginacion']= $this->pagination->create_links();
            $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id'],$opciones['per_page'], $this->uri->segment(3));
            //FIN_PAGINACION...
            
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
                    if (isset($_POST['producto_id'])){
                        $producto['producto_id']=$_POST['producto_id'];
                        $producto['imagen']= $_POST['imagen'];
                        $data['producto'] = $producto;
                        $data['contenido'] = 'usuario/editarImagenProducto';
                    }else{
                            $data['producto'] = $producto;
                         $data['contenido'] = 'usuario/publicarImagen';
                    }
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
            if($_POST['producto_id']){
                $this->load->view('usuario/editarImagenProducto', $error);
            }else{
                $this->load->view('usuario/publicarImagen', $error);
            }
        } else {
            $this->load->model('productoModel');
            $data = array('upload_data' => $this->upload->data());
            $aux = $this->upload->data();
            $producto['imagen'] = base_url().'/images/'.$aux['file_name'];
            if(isset( $_POST['producto_id'])){
                $this->productoModel->editarProducto($producto,$_POST['producto_id']);
            }else{
                $this->productoModel->agregarProducto($producto);
            }
            redirect('miCuenta');
        }
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
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Editar Producto';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['contenido'] = 'usuario/editarProducto';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
            $this->load->model('productoModel');
            $data['producto'] = $this->productoModel->getProducto($id);
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }
        function borrarProducto($id){
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Editar Producto';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['contenido'] = 'usuario/borrarProducto';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
            $this->load->model('productoModel');
            $data['producto'] = $this->productoModel->getProducto($id);
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
        }
        public function borrarProductoBd() {
        $this->load->model('productoModel');
        $id = $this->input->post('producto_id');
        $this->productoModel->borrarProducto($id);
        redirect('miCuenta');
    }

}
?>