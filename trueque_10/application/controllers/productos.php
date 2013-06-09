<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Productos extends CI_Controller {
    function Productos() {
        parent::__construct();
        $this->load->model('productoModel');
        $this->load->library('pagination');
        $this->load->library('image_lib');
    }

    public function index() {
        $data['titulo'] = "Productos Destacados";
	$data['activo'] = 1;
        $data['contenido'] = 'estandar/inicio';
        $data['title'] = 'Productos Destacados';
        $data['sidebar'] = 'sidebarCategorias';
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

        //PAGINACION...
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'productos/index/';
        $opciones['total_rows'] = $this->productoModel->getNumProductos();
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->getTodosProductos($opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
        $this->load->view('plantilla', $data);
    }

    public function verProducto($id) {
        $data['title'] = 'Trueque verProducto';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/verProducto';
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
        $data['producto'] = $this->productoModel->getProducto($id);
        $this->load->view('plantilla', $data);
    }

    public function verUsuario($id) {
        $data['title'] = 'Trueque verUsuario';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/verUsuario';
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

    public function buscarProducto() {

        static $criterio;
        if(isset($_POST['buscar'])){
            $this->form_validation->set_rules('buscar', 'Buscar',
            'trim|xss_clean|callback_seguraSQL');
            if ($this->form_validation->run() == TRUE) {
             $criterio = $this->input->post('buscar');
             $this->session->set_userdata('buscar',$criterio);
            }
        }
        else{
            $criterio=$this->session->userdata('buscar');
        }
        $data['title'] = $criterio;
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/inicio';
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
        //PAGINACION
        $cantidad = $this->productoModel->numBuscarProducto($criterio);
        $this->load->library('pagination');

        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . 'productos/buscarProducto';
        $opciones['total_rows'] = $cantidad;
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';

        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->buscarProductos($criterio, $opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION


        $this->load->view('plantilla', $data);
    }

    public function busquedaAvanzada() {
        $data['title'] = 'Resultados Busqueda Avanzada';
        $data['sidebar'] = 'sidebarCategorias';
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
        $data['contenido'] = 'estandar/busquedaAvanzada';
        $data['categoria'] = $this->productoModel->cargarCategoria();
        $data['ciudades'] = $this->productoModel->cargarCiudad();

        $this->load->view('plantilla', $data);
    }

    public function busquedaAvanzadaProducto() {

        $data['title'] = 'Resultados Busqueda Avanzada';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/inicio';
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
        
        if(isset($_POST['categorias'])){
            $categoria = $_POST['categorias'];
            $desde = $_POST['fechaIngreso'];
            $hasta = $_POST['hasta'];
            $ciudad = $_POST['ciudades'];
            $this->session->set_userdata('categorias',$categoria);
            $this->session->set_userdata('fechaIngreso',$desde);
            $this->session->set_userdata('hasta',$hasta);
            $this->session->set_userdata('ciudades',$ciudad);
        }
        else{
            $categoria = $this->session->userdata('categorias');
            $desde =$this->session->userdata('fechaIngreso');
            $hasta = $this->session->userdata('hasta');
            $ciudad = $this->session->userdata('ciudades');
        }
        //PAGINACION
        $cantidad = $this->productoModel->numBusquedaAvanzada($categoria, $desde, $hasta, $ciudad);
        $this->load->library('pagination');
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . 'productos/busquedaAvanzadaProducto/';
        $opciones['total_rows'] = $cantidad;
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';

        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->busquedaAvanzada($categoria, $desde, $hasta, $ciudad, $opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION
        
        $this->load->view('plantilla', $data);
    }
    public function getProductosSide($categoria=null){
         $data['contenido'] = 'estandar/inicio';
         $data['sidebar'] = 'sidebarCategorias';
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
        //PAGINACION...
        if(isset($categoria) && $categoria!=null && $categoria!=$this->session->userdata('numProdPag')){
            
            $data['title'] = $categoria;
            $this->session->set_userdata('nombreCategoria',$data['title']);
            $categoria=  $this->obtenerIdCategoria($categoria);
            $this->session->set_userdata('categoria',$categoria);
            $this->session->set_userdata('numProdPag',5);
        }
        else{
            $data['title'] = $this->session->userdata('nombreCategoria');
            $categoria=$this->session->userdata('categoria'); 
        }
        
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url(). 'productos/getProductosSide';
        $opciones['total_rows'] = $this->productoModel->getNumProductosCategoria($categoria);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->getCamaras($opciones['per_page'], $this->uri->segment(3),$categoria);
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
        
        
        $this->load->view('plantilla', $data);

  
    }
    public function obtenerIdCategoria($nombre){
        $categoria="";
        switch ($nombre){
                case "Antiguedades":
                    $categoria=1;
                    break;
                case "Camaras":
                    $categoria=2;
                    break;
                case "Casas":
                    $categoria=3;
                    break;
                case "Celulares":
                    $categoria=4;
                    break;
                case "Cine":
                    $categoria=5;
                    break;
                case "Computadores":
                    $categoria=6;
                    break;
                case "Deportes":
                    $categoria=7;
                    break;
                case "Electrodomesticos":
                    $categoria=8;
                    break;
                case "Joyas":
                    $categoria=9;
                    break;
                case "Juguetes":
                    $categoria=10;
                    break;
                case "Libros":
                    $categoria=11;
                    break;
                case "Licores":
                    $categoria=12;
                    break;
                case "Musica":
                    $categoria=13;
                    break;
                case "Vehiculos":
                    $categoria=14;
                    break;
                case "Videojuegos":
                    $categoria=15;
                    break;
                case "Otros":
                    $categoria=16;
                    break;
            }
            return $categoria;
    }
    function seguraSQL($str){
 
        if((stripos($str,"or")!==false)|| (stripos($str,"'")!==false)
                || (stripos($str,";")!==false)||(stripos($str,"from")!==false)
                ||(stripos($str,"drop")!==false)||(stripos($str,"delete")!==false)
                ||(stripos($str,"alter")!==false)||(stripos($str,",")!==false)
                ||(stripos($str,"where")!==false)||(stripos($str,"and")!==false)
                ||(stripos($str,"<")!==false)||(stripos($str,">")!==false)
                ||(stripos($str,"=")!==false)){
            return FALSE;
        }else{
            $this->form_validation->set_message('seguraSQL', 'Su Ingreso esta considerado como un ataque a nuestra Base de datos');
            return TRUE;
        }
    }
}