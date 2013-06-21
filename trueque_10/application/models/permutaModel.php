<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PermutaModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPermutas($current,$limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_solicita.nombre AS sol_usu_nombre, usu_solicita.apellido AS sol_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_solicita.usuario_id AS sol_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_recibe.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
        $this->db->where('p1.estado_publicacion',1);
        
        

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function getNumPermutas($current){
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_solicita.nombre AS sol_usu_nombre, usu_solicita.apellido AS sol_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_solicita.usuario_id AS sol_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_recibe.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
        $this->db->where('p1.estado_publicacion',1);
        
        

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            return FALSE;
        }
    }
    function getTodasPermutas($limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_solicita.nombre AS sol_usu_nombre, usu_solicita.apellido AS sol_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_solicita.usuario_id AS sol_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('per.fechapermuta !=',  '0000-00-00');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function getNumTodasPermutas() {
        
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_solicita.nombre AS sol_usu_nombre, usu_solicita.apellido AS sol_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_solicita.usuario_id AS sol_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('per.fechapermuta !=',  '0000-00-00');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            return FALSE;
        }
    }
    function hacerPermuta($peticion){
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        $query = $this->db->query('UPDATE permuta SET fechapermuta = CURRENT_TIMESTAMP WHERE producto_recibe = '.$recibe.' AND producto_solicita = '.$solicita); 
        $query1=  $this->db->query('update producto set usuario_id='.$usu_solicita.', estado_publicacion = 0 where producto_id='.$recibe);
        $query2=  $this->db->query('update producto set usuario_id='.$usu_recibe.', estado_publicacion = 0 where producto_id='.$solicita);
        
    }
    
    
    function rechazarPermuta($peticion){
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        $query = $this->db->query('DELETE FROM permuta where producto_recibe = '.$recibe.' and producto_solicita = '.$solicita.' and fechapermuta = \'0000-00-000\'');
    }
    
    function crearPermuta($data){
        $this->db->insert('permuta',$data);
    }
    function getPermutasEnviadas($current,$limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_recibe.nombre AS rec_usu_nombre, usu_recibe.apellido AS rec_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_recibe.usuario_id AS rec_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_solicita.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
       
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function getNumPermutasEnviadas($current) {
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_recibe.nombre AS rec_usu_nombre, usu_recibe.apellido AS rec_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_recibe.usuario_id AS rec_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_solicita.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
       
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            return FALSE;
        }
    }
    function crearReportes($anio){
        $cont=0;
        $reporte=array();
        $consulta=$this->db->get('permuta');
        foreach ($consulta->result_array() as $row):
            $reporte[$cont]=$row['fechapermuta'];
            $cont=$cont+1;
        endforeach;
        $this->load->helper('string');
        for($i=0;$i<12;$i++):
           $meses[$i]=0;
        endfor;
        for($i=0;$i<$consulta->num_rows();$i++):
            $valores=explode("-",$reporte[$i]);
        if($valores[0]==$anio){
            $meses[$valores[1]-1]++;
        }
        endfor;
        return $meses;
        
    }
     function llenarMeses(){
        $meses['enero']=0;
        $meses['febrero']=0;
        $meses['marxo']=0;
        $meses['abril']=0;
        $meses['mayo']=0;
        $meses['junio']=0;
        $meses['julio']=0;
        $meses['agosto']=0;
        $meses['septiembre']=0;
        $meses['octubre']=0;
        $meses['noviembre']=0;
        $meses['diciembre']=0;
        return $meses;
    }
    function obtenerMes($mes){
        switch ($mes){
            case 1:
                return "enero";
                break;
            case 2:
                return "febrero";
                break;
            case 3:
                return "marzo";
                break;
            case 4:
                return "abril";
                break;
            case 5:
                return "mayo";
                break;
            case 6:
                return "junio";
                break;
            case 7:
                return "julio";
                break;
            case 8:
                return "agosto";
                break;
            case 9:
                return "septiembre";
                break;
            case 10:
                return "octubre";
                break;
            case 11:
                return "noviembre";
                break;
            case 12:
                return "diciembre";
                break;
        }
    }
    function crearReportesPublicaciones($anio){
        $cont=0;
        $reporte=array();
        $consulta=$this->db->get('producto');
        foreach ($consulta->result_array() as $row):
            $reporte[$cont]=$row['fechaingreso'];
            $cont=$cont+1;
        endforeach;
        $this->load->helper('string');
        $meses=array();
        for($i=0;$i<12;$i++):
            $meses[$i]=0;
        endfor;
        for($i=0;$i<$consulta->num_rows();$i++):
            $valores=explode("-",$reporte[$i]);
        if($valores[0]==$anio){
            $meses[$valores[1]-1]++;
        }
        endfor;
        return $meses;
        
    }
}
