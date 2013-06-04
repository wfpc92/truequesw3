<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//
class PermutaModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPermutas($current) {
        
        
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_solicita.nombre AS sol_usu_nombre, usu_solicita.apellido AS sol_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_solicita.usuario_id AS sol_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_recibe.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
        
        
        

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    
    function hacerPermuta($peticion){
        echo $peticion;
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        
        $query = $this->db->query('UPDATE permuta SET fechapermuta = CURRENT_TIMESTAMP WHERE producto_recibe = '.$recibe.' AND producto_solicita = '.$solicita); 
        $query1=  $this->db->query('update producto set usuario_id='.$usu_solicita.' where producto_id='.$recibe);
        $query2=  $this->db->query('update producto set usuario_id='.$usu_recibe.' where producto_id='.$solicita);
    }
    
    
    function rechazarPermuta($peticion){
        echo $peticion;
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        $query = $this->db->query('DELETE FROM permuta where producto_recibe = '.$recibe.' and producto_solicita = '.$solicita.' and fechapermuta = \'0000-00-000\'');
    }
    
/*
    function getProducto($id) {
        $data = array();
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->where('producto_id', $id);
        $this->db->limit(1);
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            $data = $consulta->row();
        }
        $consulta->free_result();
        return $data;
    }

    public function buscarProductos($criterio) {
        
        $data = array();
        $this->load->helper('string');
        
        $valores = explode(" ", $criterio);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->like('producto.nombre', $criterio);
        foreach ($valores as $valor):
            $this->db->or_like('producto.nombre', $valor);
            $this->db->or_like('descripcion', $valor);
            $this->db->or_like('categoria', $valor);
        endforeach;
       

        $consulta = $this->db->get();
        foreach ($consulta->result() as $prod):
            echo '';
        endforeach;
        if ($consulta->num_rows() > 0) {
            $data = $consulta;
        }
        $consulta->free_result();
        return $data;
    }

    function cargarCategoria() {
        $sql = "SELECT DISTINCT categoria FROM producto";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $data[""] = "Todas las categorias";
            foreach ($query->result_array() as $row) {
                $data[$row['categoria']] = ($row['categoria']);
            }
            return $data;
        }
        return $data;
        $query->free_result();
    }

    function cargarCiudad() {

        $sql = "SELECT nombre FROM cuidad";
        $query = $this->db->query($sql);
        $ciudades = array();
        if ($query->num_rows() > 0) {
            $ciudades[""] = "Todos";
            foreach ($query->result_array() as $row) {
                $ciudades[$row['nombre']] = ($row['nombre']);
            }
            return $ciudades;
        }
        return $ciudades;
        $query->free_result();
    }

    function getMisProductos($id) {
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->where('producto.usuario_id', $id);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
     
    function busquedaAvanzada($categoria,$desde,$hasta, $ciudad){
        
        $data = array();
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('cuidad', 'usuarios.id_ciudad=cuidad.id');

        if($categoria!=""){
            $this->db->where('categoria', $categoria);
        }
        if($desde != ""){
                $this->db->where('fechaingreso >=', $desde);  
                
        }
        if($hasta != ""){
                $this->db->where('fechaingreso <=', $hasta); 
        }
        if($ciudad!=""){
                $this->db->where('cuidad.nombre', $ciudad);  
        }  
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
*/
}
