<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//
class Productos extends CI_Controller {
	
	function Productos(){
		parent::__construct();
		$this->load->model('productoModel');
	}
	
	public function index()
	{
		$data['contenido']='contenido';
		$data['title']='Trueque Inicio';
		$data['sidebar']='sidebarCategorias';
        $usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
            {
                $data['sesion']='sesionUsuario';
                $data['menu']='menuUsuario';
                $data['usuarioActual'] = $usuarioActual;
                if($usuarioActual['usuario_nivel']==0){$data['menu']='menuAdministrador';}
            }   
            else
            {
                $data['sesion']='sesionLogin';
                $data['menu']='menuEstandar';
            }
        $data['productos'] = $this->productoModel->getProductos();
        $this->load->view('plantilla', $data);
	}
	public function verProducto($id) {
		$data['title']='Trueque verProducto';
		$data['sidebar']='sidebarCategorias';
		$data['contenido'] = 'verProducto';
		$usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
        	{
        		$data['sesion']='sesionUsuario';
        		$data['menu']='menuUsuario';
        		$data['usuarioActual'] = $usuarioActual;
                if($usuarioActual['usuario_nivel']==0){$data['menu']='menuAdministrador';}
        	}	
        	else
        	{
        		$data['sesion']='sesionLogin';
        		$data['menu']='menuEstandar';
        	}
        $data['producto'] = $this->productoModel->getProducto($id);
        $this->load->view('plantilla', $data);
    }
    
    public function verUsuario($id) {
        $data['title']='Trueque verUsuario';
		$data['sidebar']='sidebarCategorias';
		$data['contenido'] = 'verUsuario';
		$usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
        	{
        		$data['sesion']='sesionUsuario';
        		$data['menu']='menuUsuario';
        		$data['usuarioActual'] = $usuarioActual;
                if($usuarioActual['usuario_nivel']==0){$data['menu']='menuAdministrador';}
        	}	
        	else
        	{
        		$data['sesion']='sesionLogin';
        		$data['menu']='menuEstandar';
        	}
        $this->load->view('plantilla', $data);
    }
    
    public function buscarProducto(){
        $criterio=  $this->input->post('buscar');
        $data['title']='Trueque Buscar Producto';
		$data['sidebar']='sidebarCategorias';
		$data['contenido'] = 'contenido';
		$usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
        	{
        		$data['sesion']='sesionUsuario';
        		$data['menu']='menuUsuario';
        		$data['usuarioActual'] = $usuarioActual;
                if($usuarioActual['usuario_nivel']==0){$data['menu']='menuAdministrador';}
        	}	
        	else
        	{
        		$data['sesion']='sesionLogin';
        		$data['menu']='menuEstandar';
        	}
        $data['productos'] = $this->productoModel->buscarProductos($criterio);
        $this->load->view('plantilla', $data);
    }
    public function busquedaAvanzada(){
    	$data['title']='Trueque Buscar Producto';
		$data['sidebar']='sidebarCategorias';
		$usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
        	{
        		$data['sesion']='sesionUsuario';
        		$data['menu']='menuUsuario';
        		$data['usuarioActual'] = $usuarioActual;
                if($usuarioActual['usuario_nivel']==0){$data['menu']='menuAdministrador';}
        	}	
        	else
        	{
        		$data['sesion']='sesionLogin';
        		$data['menu']='menuEstandar';
        	}
         $data['contenido'] = 'busquedaAvanzada';
         $data['categoria'] = $this->productoModel->cargarCategoria();
         $data['ciudades'] = $this->productoModel->cargarCiudad();
         
         $this->load->view('plantilla', $data);
    }
    
    
     public function busquedaAvanzadaProducto(){
        
         $data['title']='Trueque Buscar Producto';
		$data['sidebar']='sidebarCategorias';
		$data['contenido'] = 'contenido';
		$usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
        	{
        		$data['sesion']='sesionUsuario';
        		$data['menu']='menuUsuario';
        		$data['usuarioActual'] = $usuarioActual;
                if($usuarioActual['usuario_nivel']==0){$data['menu']='menuAdministrador';}
        	}	
        	else
        	{
        		$data['sesion']='sesionLogin';
        		$data['menu']='menuEstandar';
        	}
        
        
         $categoria= $_POST['categorias'];
         $desde= $_POST['fechaIngreso'];
       
         $hasta= $_POST['hasta'];
         $ciudad=  $_POST['ciudades'];
                                           
         //echo 'en el controlador'.$categoria;
         //echo $categoria;
        //$busquedaAvanzada['data']=$this->productoModel->busquedaAvanzadaProducto($categoria,$desde,$hasta, $ciudad);
        //$this->load->view('Borrador',$busquedaAvanzada);
        
        $data['contenido'] = 'contenido';
        $data['productos'] =$this->productoModel->busquedaAvanzada($categoria,$desde,$hasta, $ciudad);
        $this->load->view('plantilla', $data);
    }
    
    
}