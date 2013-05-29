<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
class Inicio extends CI_Controller {
	function _construct(){
		parent::_construct();
	}
	public function index()
	{
		$data['contenido']='contenido';
		$data['title']='Trueque Inicio';
		$data['sidebar']='sidebarCategorias';
		$data['sesion']='sesionLogin';
		$data['menu']='menuEstandar';
        $this->load->view('plantilla',$data);
	}
}
?>