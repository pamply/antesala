<?php
class mciudad extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "municipios";
        $this->alias = 'm';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".titulo";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".titulo";
    }
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array();
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function getById($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.id' => $id);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }

    }

    function getCiudadByIdEstado($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.estado_id' => $id);
        $this->db->join('propiedad AS p',$this->alias.'.id = p.ciudad');
        $this->db->where($arrayWhere);
        $this->db->group_by($this->alias.'.id');
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }

    }

    function getWhereIn($ids){
        $this->db->select($this->selectDefault,FALSE);
        //$arrayWhere = array($this->alias.'.estado_id' => $id);
        $this->db->where_in($this->alias.'.id',$ids);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return 0;
        }
    }


}