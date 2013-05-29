<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//
class PermutaModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPermutas() {
        $this->db->select('producto_recibe, producto_solicita, fechapermuta, nombre, descripcion, categoria, imagen,fechaingreso');
        $this->db->from('permuta');
        $this->db->join('producto', 'producto.producto_id = producto_recibe');
        $this->db->join('producto', 'producto.producto_id = producto_solicita');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
       
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
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
