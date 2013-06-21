<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MiCuenta extends CI_Controller {

    function _construct() {
        parent::_construct();
    }

    public function index() {
        $data['titulo'] = "miCuenta";
        $data['sideSelect']=0;
	$data['activo'] = 2;
        $this->load->model('productoModel');
        $this->load->library('pagination');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Mis Productos';
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
        $data['activo'] = 2;
        $data['sideSelect']=1;
        $this->load->model('productoModel');
        $this->load->library('pagination');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['title'] = 'Productos Sin Publicar';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/productosNoPublicados';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';

            //PAGINACION...
            $opciones = array();
            $opciones['per_page'] = 5;
            $opciones['base_url'] = base_url() . 'miCuenta/productosNoPublicados/';
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
        $data['activo'] = 2;
        $data['sideSelect']=0;
        $data=$this->cargarEstandar();
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
            
            if(isset($usuarioActual['nombre'])&& $usuarioActual['usuario_nivel'] == 0){
                $data['sidebar'] = 'sidebarAdministrar';
                $data['sesion'] = 'sesionUsuario';
                $data['usuarioActual']=$usuarioActual;
                $data['mensajeAprobacion'] = 'Tu Como Administrador </br> No Puedes 
                Truequear Productos. <a href=\'http://localhost/trueque_10\'>Volver</a>';
            }else{
                echo "<h1>entro por el else </h1>";
                $data['sesion']='sesionLogin';
                $data['mensajeAprobacion'] = 'Para Truequear un Producto <br/> debes 
                <a href=\'http://localhost/trueque_10/usuarios/registrar\'>Registrarte</a>
                o Iniciar Sesion';
            }
            $data['contenido']='estandar/error';
            $this->load->view('plantilla', $data);
        }
    }
    public function cargarEstandar(){
        $data['title']='inicio';
        $data['sesion']='sesionLogin';
        $data['menu']='menuEstandar';
        $data['sidebar']='sidebarCategorias';
        return $data;
    }

    public function enviarTrueque() {
        $this->load->model('permutaModel');
        $data['producto_recibe'] = $_POST['productoSolicita'];
        $data['producto_solicita'] = $_POST['productoEnvia'];
        $this->permutaModel->crearPermuta($data);
        $data=array();
        $usuarioActual = $this->session->all_userdata();
        $data['usuarioActual']=$usuarioActual;
        $data['title']='trueque enviado';
        $data['menu']='menuUsuario';
        $data['sesion']='sesionUsuario';
        $data['sidebar']='sidebarMiCuenta';
        $data['contenido']='estandar/exito';
        $data['mensajeAprobacion']='Propuesta Enviada Correctamente <br/>
            Mira <a href=\'http://localhost/trueque_10/permutas/permutasEnviadas\'>Tus Propuestas Enviadas</a> o <a href=\'http://localhost/trueque_10/productos\'>Busca mas Productos</a>';
        $this->load->view('plantilla',$data);
    }

    public function publicarProducto() {
        $data['sideSelect']=2;
        $data['activo'] = 2;
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['contenido'] = 'usuario/publicarProducto';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $data['title'] = 'Publicar Producto';
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    function guardarProducto() {
        $data['sideSelect']=2;
        $data['activo'] = 2;
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $data['title'] ='Publicar Producto';
            if (isset($_POST['producto_id'])) {
                        $data['contenido'] = 'usuario/editarProducto';
                    } else {
                        $data['contenido'] = 'usuario/publicarProducto';
                    }
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'nombre',
                        'label' => 'nombre',
                        'rules' => 'trim|required|xss_clean|callback_seguraSQL'
                    ),
                    array(
                        'field' => 'categoria',
                        'label' => 'categoria',
                        'rules' => 'trim|callback_seleccionar'
                    ),
                    array(
                        'field' => 'descripcion',
                        'label' => 'descripcion',
                        'rules' => 'trim|required|xss_clean|callback_seguraSQL'
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
        $data['sideSelect']=2;
        $data['activo'] = 2;
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
            $data['error'] = $this->upload->display_errors();
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['usuarioActual']=$usuarioActual;
            $data['producto']=$producto;
            $data['title'] = 'Publicar Producto';
            $data['contenido'] = 'usuario/publicarImagen';
            $this->load->view('plantilla', $data);
        } else {
            $this->load->model('productoModel');
            $data = array('upload_data' => $this->upload->data());
            $aux = $this->upload->data();
            $producto['imagen'] = base_url() . '/images/' . $aux['file_name'];
            $this->productoModel->agregarProducto($producto);
            redirect('miCuenta');
        }
        }else{redirect(base_url());}
    }
    function guardarEditarImagen() {
        $data['sideSelect']=2;
        $data['activo'] = 2;
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1){
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '800';
        $config['max_height'] = '600';
        $producto = $_POST['producto'];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $aux = $this->upload->data();
            $producto['imagen'] = base_url() . '/images/' . $aux['file_name'];
        }
            $this->load->model('productoModel');
            $this->productoModel->editarProducto($producto,$producto['producto_id']);
            redirect('miCuenta');
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
    function editarProducto() {
        $data['sideSelect']=2;
        $data['activo'] = 2;
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
            $data['producto'] = $this->productoModel->getProducto($_POST['producto_id']);
            $data['categoria'] = $this->productoModel->cargarCategoria();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    function borrarProducto() {
        $data['sideSelect']=0;
        $data['activo'] = 2;
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
            $data['producto'] = $this->productoModel->getProducto($_POST['producto_id']);
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
        $data['sideSelect']=5;
        $data['activo'] = 2;
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 1) {
            $usuario = $this->usuariosModel->getUsuario($usuarioActual['usuario_id']);
            $data['title'] = 'Editar Informacion';
            $data['sidebar'] = 'sidebarMiCuenta';
            $data['contenido'] = 'usuario/editarInformacion';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['usuario'] = $usuario;
            $data['ciudades'] = $this->productoModel->cargarCiudad();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function guardarInformacion() {
        $data['sideSelect']=5;
        $data['activo'] = 2;
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
                    'rules' => 'trim|required|xss_clean|callback_seguraSQL'
                ),
                array(
                    'field' => 'usuario[apellido]',
                    'label' => 'Apellido',
                    'rules' => 'trim|required|xss_clean|callback_seguraSQL'
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
                }
                $usuario['usuario_id']=$usuarioActual['usuario_id'];
                $usuario['id_ciudad'] = $this->input->post('ciudad');
                $this->usuariosModel->setUsuario($usuario);
                $this->session->set_userdata('nombre', $usuario['nombre']);
                $this->session->set_userdata('avatar', $usuario['avatar']);
                redirect('miCuenta');
            }
        } else {
            redirect(base_url());
        }
    }
    public function darDeAlta(){
        $this->load->model('productoModel');
        $this->productoModel->darDeAlta($_POST['producto_id']);
        redirect('miCuenta/productosNoPublicados');
    }
    public function darDeBaja(){
        $this->load->model('productoModel');
        $this->productoModel->darDeBaja($_POST['producto_id']);
        redirect('miCuenta');
    }
    function seguraSQL($str){
        if((stripos($str,"' ")!==false)||(stripos($str," from ")!==false)
                ||(stripos($str," drop ")!==false)||(stripos($str," delete ")!==false)
                ||(stripos($str," alter ")!==false)||(stripos($str," where ")!==false)||(stripos($str," and ")!==false)
                ||(stripos($str,"<")!==false)||(stripos($str,">")!==false)
                ||(stripos($str,"=")!==false)){
            $this->form_validation->set_message('seguraSQL', 'Su Ingreso esta considerado como un ataque a nuestra Base de datos');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function verMiProducto($id) {
        $this->load->model('productoModel');
        $data['sideSelect']=0;
        $data['activo'] = 2;
        $data['title'] = 'Trueque verProducto';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'usuario/verMiProducto';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
             $data['sidebar'] = 'sidebarMiCuenta';
            $data['usuarioActual'] = $usuarioActual;
            if ($usuarioActual['usuario_nivel'] == 0) {
                $data['menu'] = 'menuAdministrador';
            }
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
        }
        $data['producto'] = $this->productoModel->getProducto($id);
        $this->load->view('plantilla', $data);
    }
    function donacion(){
        $data['sideSelect']=6;
        $data['activo'] = 2;
        $data['title'] = 'Donacion Voluntaria';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/inicio';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['contenido'] = 'usuario/donacion';
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
             $data['sidebar'] = 'sidebarMiCuenta';
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
    
    function donacionExitosa(){
            $data=array();
        $usuarioActual = $this->session->all_userdata();
        $data['usuarioActual']=$usuarioActual;
        $data['title']='Solicitud enviada';
        $data['menu']='menuUsuario';
        $data['sesion']='sesionUsuario';
        $data['sidebar']='sidebarMiCuenta';
        $data['contenido']='estandar/exito';
        $data['mensajeAprobacion']='Gracias por su donaci&oacute;n';
        $this->load->view('plantilla',$data);
    }
    
    function nuevaContrasena(){
        $data['activo'] = 1;
        $data=  $this->cargarEstandar();
        $data['title'] = 'Trueque Cambio Exitoso';
        $data['contenido']='miCuenta/nuevaContrasena';
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'contrasena',
                    'label' => 'Contraseña',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'confirmarcontrasena',
                    'label' => 'Confirmar Contraseña',
                    'rules' => 'trim|required|matches[contrasena]'
                )
            );
            $this->load->library('form_validation');
            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('matches', 'El campo %s no coincide');
            if ($this->form_validation->run() == FALSE) {
                $data['errores'] = validation_errors();
            } else {
                $usuarioActual = $this->session->all_userdata();
                $nuevaContrasena = $_POST['contrasena'];
                $id = $usuarioActual['usuario_id'];
                $this->load->model('usuariosModel');
                $this->usuariosModel->cambiarContrasena($id,$nuevaContrasena);
                $data['title'] = 'inicio';
                $data['sesion'] = 'sesionUsuario';
                $data['menu'] = 'menuUsuario';
                $data['sidebar'] = 'sidebarMicuenta';
                $data['usuarioActual']=$usuarioActual;
                $data['contenido'] = 'estandar/exito';
                $data['mensajeAprobacion']='Contrase&ntilde;a cambiada exit&oacute;samente.';
                }
            }
        $this->load->view("plantilla", $data);
    }
}
?>	