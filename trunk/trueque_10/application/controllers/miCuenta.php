<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MiCuenta extends CI_Controller {

    function _construct() {
        parent::_construct();
    }

    public function index() {
         $data['titulo'] = "miCuenta";
	$data['activo'] = 2;
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
            $opciones['base_url'] = base_url() . 'miCuenta/index/';
            $opciones['total_rows'] = $this->productoModel->numMisProductos($usuarioActual['usuario_id']);
            ;
            $opciones['uri_segment'] = 3;
            $opciones['num_links'] = 3;
            $opciones['first_link'] = 'Primero';
            $opciones['last_link'] = 'Ultimo';
            $this->pagination->initialize($opciones);
            $data['paginacion'] = $this->pagination->create_links();
            $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id'], $opciones['per_page'], $this->uri->segment(3));
            //FIN_PAGINACION...

            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }
    public function productosNoPublicados() {
        $this->load->model('productoModel');
        $this->load->library('pagination');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Trueque Mi Cuenta';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/productosNoPublicados';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';

            //PAGINACION...
            $opciones = array();
            $opciones['per_page'] = 5;
            $opciones['base_url'] = base_url() . 'miCuenta/index/';
            $opciones['total_rows'] = $this->productoModel->numMisProductosNP($usuarioActual['usuario_id']);
            ;
            $opciones['uri_segment'] = 3;
            $opciones['num_links'] = 3;
            $opciones['first_link'] = 'Primero';
            $opciones['last_link'] = 'Ultimo';
            $this->pagination->initialize($opciones);
            $data['paginacion'] = $this->pagination->create_links();
            $data['productos'] = $this->productoModel->getMisProductosNP($usuarioActual['usuario_id'], $opciones['per_page'], $this->uri->segment(3));
            //FIN_PAGINACION...

            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }
    public function truequear() {
        $this->load->model('productoModel');
        $this->load->library('pagination');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Seleccionar Producto';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/misProductosSeleccionar';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            if (isset($_POST['productoSolicita'])) {
                $data['productoSolicita'] = $_POST['productoSolicita'];
                $this->session->set_userdata('productoSolicita', $data['productoSolicita']);
            } else {
                $data['productoSolicita'] = $this->session->userdata('productoSolicita');
            }
            //PAGINACION...
            $opciones = array();
            $opciones['per_page'] = 5;
            $opciones['base_url'] = base_url() . 'miCuenta/truequear/';
            $opciones['total_rows'] = $this->productoModel->numMisProductos($usuarioActual['usuario_id']);
            ;
            $opciones['uri_segment'] = 3;
            $opciones['num_links'] = 3;
            $opciones['first_link'] = 'Primero';
            $opciones['last_link'] = 'Ultimo';
            $this->pagination->initialize($opciones);
            $data['paginacion'] = $this->pagination->create_links();
            $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id'], $opciones['per_page'], $this->uri->segment(3));
            //FIN_PAGINACION...

            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function enviarTrueque() {
        $this->load->model('permutaModel');
        $data['producto_recibe'] = $_POST['productoSolicita'];
        $data['producto_solicita'] = $_POST['productoEnvia'];
        $this->permutaModel->crearPermuta($data);
        redirect(base_url());
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
                        'rules' => 'trim|required|xss_clean|alpha_numeric|callback_seguraSQL'
                    ),
                    array(
                        'field' => 'categoria',
                        'label' => 'categoria',
                        'rules' => 'trim|callback_seleccionar'
                    ),
                    array(
                        'field' => 'descripcion',
                        'label' => 'descripcion',
                        'rules' => 'trim|required|xss_clean|alpha_dash|callback_seguraSQL'
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
                    if (isset($_POST['producto_id'])) {
                        $producto['producto_id'] = $_POST['producto_id'];
                        $producto['imagen'] = $_POST['imagen'];
                        $data['producto'] = $producto;
                        $data['contenido'] = 'usuario/editarImagenProducto';
                    } else {
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
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1){
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '800';
        $config['max_height'] = '600';
        $producto = $_POST['producto'];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $data['error'] = array('error' => $this->upload->display_errors());
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['usuarioActual']=$usuarioActual;
            $data['producto']=$producto;
            if (isset($_POST['producto_id'])) {
                $data['contenido'] = 'usuario/editarImagenProducto';
                $data['producto']['producto_id']=$_POST['producto_id'];
                $this->load->view('plantilla', $data);
            } else {
                $data['contenido'] = 'usuario/publicarImagen';
            }
        } else {
            $this->load->model('productoModel');
            $data = array('upload_data' => $this->upload->data());
            $aux = $this->upload->data();
            $producto['imagen'] = base_url() . '/images/' . $aux['file_name'];
            if (isset($_POST['producto_id'])) {
                $this->productoModel->editarProducto($producto, $_POST['producto_id']);
            } else {
                $this->productoModel->agregarProducto($producto);
            }
            redirect('miCuenta');
        }
        }else{redirect(base_url());}
    }

    function seleccionar($str) {
        if ($str == "") {
            $this->form_validation->set_message('seleccionar', 'El campo %s No se ha seleccionado');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function editarProducto($id) {
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Editar Producto';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['contenido'] = 'usuario/editarProducto';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuEstandar';
            $this->load->model('productoModel');
            $data['producto'] = $this->productoModel->getProducto($id);
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    function borrarProducto($id) {
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Editar Producto';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['contenido'] = 'usuario/borrarProducto';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sesion'] = 'sesionUsuario';
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

    public function editarInformacion() {
        $this->load->model('usuariosModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $usuario = $this->usuariosModel->getUsuario($usuarioActual['usuario_id']);
            $data['title'] = 'Editar Informacion';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['contenido'] = 'usuario/editarInformacion';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuEstandar';
            $data['usuario'] = $usuario;
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function guardarInformacion() {
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $this->load->model('usuariosModel');
            $this->load->library('form_validation');
            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '800';
            $config['max_height'] = '600';
            $this->load->library('upload', $config);
            $config = array(
                array(
                    'field' => 'usuario[nombre]',
                    'label' => 'Nombre',
                    'rules' => 'trim|required|xss_clean|alpha_dash|callback_seguraSQL'
                ),
                array(
                    'field' => 'usuario[apellido]',
                    'label' => 'Apellido',
                    'rules' => 'trim|required|xss_clean|alpha_dash|callback_seguraSQL'
                )
            );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', 'El campo %s es requerido');

            if (!$this->upload->do_upload() && $this->form_validation->run() == FALSE) {
                $data['errorImg'] = $this->upload->display_errors();
                $data['error'] = validation_errors();
                $usuario = $this->usuariosModel->getUsuario($usuarioActual['usuario_id']);
                $data['title'] = 'Editar Informacion';
                $data['sidebar'] = 'sidebarMiCuenta';
                $data['contenido'] = 'usuario/editarInformacion';
                $data['sesion'] = 'sesionUsuario';
                $data['menu'] = 'menuUsuario';
                $data['usuarioActual'] = $usuarioActual;
                $data['sesion'] = 'sesionUsuario';
                $data['menu'] = 'menuEstandar';
                $data['usuario'] = $usuario;
                $this->load->view('plantilla', $data);
            } else {
                $aux = $this->upload->data();
                $usuario=$_POST['usuario'];
                if($aux['file_name']!=""){
                    $usuario['avatar'] = base_url() . '/images/' . $aux['file_name'];
                }else{
                    $usuario['avatar'] = base_url() . '/images/avatar.jpg';
                }
                $usuario['usuario_id']=$usuarioActual['usuario_id'];
                $this->usuariosModel->setUsuario($usuario);
                $this->session->set_userdata('nombre', $usuario['nombre']);
                $this->session->set_userdata('avatar', $usuario['avatar']);
                redirect('miCuenta');
            }
        } else {
            redirect(base_url());
        }
    }
    public function darDeAlta($id){
        $this->load->model('productoModel');
        $this->productoModel->darDeAlta($id);
        redirect('miCuenta');
    }
    public function darDeBaja($id){
        $this->load->model('productoModel');
        $this->productoModel->darDeBaja($id);
        redirect('miCuenta');
    }
    function seguraSQL($str){
        if((stripos($str,"or")!==false)|| (stripos($str,"'")!==false)
                || (stripos($str,";")!==false)||(stripos($str,"from")!==false)
                ||(stripos($str,"drop")!==false)||(stripos($str,"delete")!==false)
                ||(stripos($str,"alter")!==false)||(stripos($str,"where")!==false)||(stripos($str,"and")!==false)
                ||(stripos($str,"<")!==false)||(stripos($str,">")!==false)
                ||(stripos($str,"=")!==false)){
            return FALSE;
        }else{
            $this->form_validation->set_message('seguraSQL', 'Su Ingreso esta considerado como un ataque a nuestra Base de datos');
            return TRUE;
        }
    }
}
?>	