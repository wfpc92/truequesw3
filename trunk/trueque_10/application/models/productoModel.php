<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
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
    function getTodosProductos($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $data = $this->db->get();
        return $data;
    }

    function getNumProductos() {
        return $this->db->count_all('producto');
    }

    //FIN_PAGINACION

    function getProducto($id) {
        $data = array();
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
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

    public function buscarProductos($criterio, $limit, $start) {
        /* creamos una variable array vacia */
        $data = array();
        $this->load->helper('string');
        /* se hace la consulta sobre la base de datos */
        $valores = explode(" ", $criterio);

        $this->db->limit($limit, $start);


        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->like('producto.nombre', $criterio);
        foreach ($valores as $valor):
            $this->db->or_like('producto.nombre', $valor);
            $this->db->or_like('descripcion', $valor);
            $this->db->or_like('categoria.nombre', $valor);
        endforeach;
        /* nos aseguramos de que pare de buscar cuando encuentre el primer resultado puesto
          a que estamos buscando la tupla   con su llave asi que solo habra un resultado */
        /* obtenemos y guardamos el resultado de la consulta
          dentro de la variable consulta */

        $consulta = $this->db->get();
        foreach ($consulta->result() as $prod):
            echo '';
        endforeach;
        /* se comprueba si hubo algun resultado en la consulta,si es asi se asigna a 
          data este resultado, de lo contrario data se retorna como se declaro, vacio */
        if ($consulta->num_rows() > 0) {
            $data = $consulta;
        }
        /* se hace la liberacion de la variable consulta */
        $consulta->free_result();
        return $data;
    }

    //PAGINACION 
    public function numBuscarProducto($criterio) {
        /* creamos una variable array vacia */
        $this->load->helper('string');
        /* se hace la consulta sobre la base de datos */
        $valores = explode(" ", $criterio);

        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->like('producto.nombre', $criterio);
        foreach ($valores as $valor):
            $this->db->or_like('producto.nombre', $valor);
            $this->db->or_like('descripcion', $valor);
            $this->db->or_like('categoria.nombre', $valor);
        endforeach;
        /* nos aseguramos de que pare de buscar cuando encuentre el primer resultado puesto
          a que estamos buscando la tupla   con su llave asi que solo habra un resultado */
        /* obtenemos y guardamos el resultado de la consulta
          dentro de la variable consulta */

        $consulta = $this->db->get();

        return $consulta->num_rows();
    }

    //FIN_PAGINACION

    function cargarCategoria() {
        $sql = "SELECT nombre,categoria_id FROM categoria";
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

        $sql = "SELECT id, nombre FROM cuidad";
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

    function getMisProductos($id) {
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');
        $this->db->where('producto.usuario_id', $id);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }

    function busquedaAvanzada($categoria, $desde, $hasta, $ciudad) {

        $data = array();
        $this->db->select('producto_id, producto.nombre AS p_nombre, descripcion, categoria.nombre AS categoria, imagen, fechaingreso, usuarios.usuario_id AS u_id, usuarios.nombre AS u_nombre, usuarios.apellido AS u_apellido');
        $this->db->from('producto');
        $this->db->join('usuarios', 'producto.usuario_id = usuarios.usuario_id');
        $this->db->join('cuidad', 'usuarios.id_ciudad=cuidad.id');
        $this->db->join('categoria','categoria.categoria_id = producto.categoria_id');

        if ($categoria != "") {
            $this->db->where('categoria', $categoria);
        }
        if ($desde != "") {
            $this->db->where('fechaingreso >=', $desde);
        }
        if ($hasta != "") {
            $this->db->where('fechaingreso <=', $hasta);
        }
        if ($ciudad != "") {
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
    
    public function agregarProducto($data){
        $this->db->insert('producto',$data);
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

}
