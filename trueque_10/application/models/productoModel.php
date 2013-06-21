<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProductoModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getProductos() {
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }

    //PAGINACION
    function getTodosProductos($limit, $start,$id) {
        $this->db->limit($limit, $start);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('estado_publicacion',1);
        if($id!=NULL){
            $this->db->where('usuarios.usuario_id !=',$id);
        }
        $data = $this->db->get();
        return $data;
    }

    function getNumProductos($id) {
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('estado_publicacion',1);
        if($id!=NULL){
            $this->db->where('usuarios.usuario_id !=',$id);
        }
        $data = $this->db->get();
        return $data->num_rows();
    }

    //FIN_PAGINACION

    function getProducto($id) {
        $data = array();
        $this->db->select('producto_id, imagen, producto.categoria_id AS categoria_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('producto_id', $id);
        $this->db->limit(1);
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            $data = $consulta->row();
        }
        $consulta->free_result();
        return $data;
    }

    public function buscarProductos($str, $limit, $start=null,$id) {
        $data=array();
        $criterio=mysql_real_escape_string($str);
        $this->load->helper('string');
        $valores = explode(" ", $criterio);
        $query = "SELECT `producto_id`, `producto`.`nombre` AS p_nombre, `descripcion`, ";
        $query = $query." `categoria`.`nombre` AS categoria, `imagen`, `fechaingreso`, ";
        $query = $query." `usuarios`.`usuario_id` AS u_id, `usuarios`.`nombre` AS u_nombre, "; 
        $query = $query." `usuarios`.`apellido` AS u_apellido "; 
        $query = $query." FROM (`producto`) JOIN `usuarios` ON `producto`.`usuario_id` = `usuarios`.`usuario_id` ";
        $query = $query." JOIN `categoria` ON `categoria`.`categoria_id` = `producto`.`categoria_id` "; 
        $query = $query." WHERE `estado_publicacion` = 1 "; 
        if($id!=null){
            $query=$query." AND `producto`.`usuario_id`!= '".$id."'";
        }
        $query = $query." AND (`producto`.`nombre` LIKE '%".$criterio."%'";
        foreach ($valores as $valor): 
            $query = $query.' OR `producto`.`nombre` LIKE \'%'.$valor.'%\''; 
            $query = $query.' OR `descripcion` LIKE \'%'.$valor.'%\''; 
            $query = $query.' OR `categoria`.`nombre` LIKE \'%'.$valor.'%\'';
        endforeach;
        $query=$query.")";
        $query=$query.' LIMIT '.$limit;
        if($start!=null&&isset($start)&&$start!=""){
            $query=$query.' OFFSET '.$start;
        }
        $consulta =$this->db->query($query);
        foreach ($consulta->result() as $prod):
            echo '';
        endforeach;
        if ($consulta->num_rows() > 0) {
            $data = $consulta;
        }
        $consulta->free_result();
        return $data;
    }

    //PAGINACION 
    public function numBuscarProducto($criterio,$id) {
        $this->load->helper('string');
        $valores = explode(" ", $criterio);
        $query = "SELECT `producto_id`, `producto`.`nombre` AS p_nombre, `descripcion`, ";
        $query = $query." `categoria`.`nombre` AS categoria, `imagen`, `fechaingreso`, ";
        $query = $query." `usuarios`.`usuario_id` AS u_id, `usuarios`.`nombre` AS u_nombre, "; 
        $query = $query." `usuarios`.`apellido` AS u_apellido "; 
        $query = $query." FROM (`producto`) JOIN `usuarios` ON `producto`.`usuario_id` = `usuarios`.`usuario_id` ";
        $query = $query." JOIN `categoria` ON `categoria`.`categoria_id` = `producto`.`categoria_id` "; 
        $query = $query." WHERE `estado_publicacion` = 1 "; 
        $query = $query." AND `producto`.`nombre` LIKE '%".$criterio."%'";
        if($id!=null){
            $query=$query." AND `producto`.`usuario_id`!= '".$id."'";
        }
        foreach ($valores as $valor): 
            $query = $query.' OR `producto`.`nombre` LIKE \'%'.$valor.'%\''; 
            $query = $query.' OR `descripcion` LIKE \'%'.$valor.'%\''; 
            $query = $query.' OR `categoria`.`nombre` LIKE \'%'.$valor.'%\'';
        endforeach;
        $consulta=$this->db->query($query);
        return $consulta->num_rows();
    }

    //FIN_PAGINACION

    function cargarCategoria() {
        $sql = "SELECT nombre,categoria_id FROM categoria ORDER BY nombre";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $data[""] = "Todas las Categorias";
            foreach ($query->result_array() as $row) {
                $data[$row['categoria_id']] = ($row['nombre']);
            }
            return $data;
        }
        $query->free_result();
        return $data;
    }

    function cargarCiudad() {

        $sql = "SELECT id, nombre FROM cuidad ORDER BY nombre";
        $query = $this->db->query($sql);
        $ciudades = array();
        if ($query->num_rows() > 0) {
            $ciudades[""] = "Todos las ciudades";
            foreach ($query->result_array() as $row) {
                $ciudades[$row['id']] = ($row['nombre']);
            }
            return $ciudades;
        }
        $query->free_result();
        return $ciudades;
    }

    function getMisProductos($id,$limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('producto.usuario_id', $id);
        $this->db->where('estado_publicacion',1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function numMisProductos($id) {
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('producto.usuario_id', $id);
        $this->db->where('estado_publicacion',1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            return FALSE;
        }
    }
    function getMisProductosNP($id,$limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('producto.usuario_id', $id);
        $this->db->where('estado_publicacion',0);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function numMisProductosNP($id) {
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('producto.usuario_id', $id);
        $this->db->where('estado_publicacion',0);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            return FALSE;
        }
    }

    function busquedaAvanzada($categoria, $desde, $hasta, $ciudad,$limit,$start,$id) {

        $data = array();
        $this->db->limit($limit, $start);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        
        if ($categoria != "") {
            $this->db->where('producto.categoria_id',$categoria);
        }
        if ($desde != "") {
            $this->db->where('fechaingreso >=', $desde);
        }
        if ($hasta != "") {
            $this->db->where('fechaingreso <=', $hasta);
        }
        if ($ciudad != "") {
            $this->db->where('usuarios.id_ciudad',$ciudad);
        }
        if($id!=NULL){
             $this->db->where('producto.usuario_id !=',$id);
        }
        $this->db->where('estado_publicacion',1);
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            $data = $consulta;

            foreach ($data->result() as $producto):
                echo '';
            endforeach;
        }
        $consulta->free_result();
        return $data;
    }
    function numBusquedaAvanzada($categoria, $desde, $hasta, $ciudad,$id) {

         $data = array();
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        
        if ($categoria != "") {
            $this->db->where('producto.categoria_id',$categoria);
        }
        if ($desde != "") {
            $this->db->where('fechaingreso >=', $desde);
        }
        if ($hasta != "") {
            $this->db->where('fechaingreso <=', $hasta);
        }
        if ($ciudad != "") {
            $this->db->where('usuarios.id_ciudad',$ciudad);
        }
        if($id!=NULL){
             $this->db->where('producto.usuario_id !=',$id);
        }
        $this->db->where('estado_publicacion',1);
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }
    
    public function agregarProducto($data){
        $this->db->insert('producto',$data);
        return TRUE;
    }
    public function editarProducto($data,$id){
        $this->db->where('producto_id', $id);
        $this->db->update('producto', $data);
        return TRUE;
    }
    function borrarProducto($id) {
        $this->db->where('producto_id', $id);
        $this->db->limit(1);
        $this->db->delete('producto');
        return TRUE;
    }
    
    /*sidebar*/
    function getCamaras($limit,$start,$categoria){
        $this->db->limit($limit, $start);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->where('categoria.categoria_id', $categoria);
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $data = $this->db->get();
        return $data;
    }
    
    function getNumProductosCategoria($categoria){
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->where('categoria.categoria_id', $categoria);
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $data = $this->db->get();
        return $data->num_rows();
    }
    
    function darDeAlta($id){
        $data['estado_publicacion']=1;
        $this->db->where('producto_id', $id);
        $this->db->update('producto', $data);
        return TRUE;
    }
    function darDeBaja($id){
        $data['estado_publicacion']=0;
        $this->db->where('producto_id', $id);
        $this->db->update('producto', $data);
        return TRUE;
    }
}
