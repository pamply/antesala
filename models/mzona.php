<?php
class mzona extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "zona";
        $this->alias = 'z';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".titulo";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".titulo
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";
    }

    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        //$arrayWhere = array($this->alias.'.status' => true);
        //$this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if ($query->num_rows > 0){
            return $query;
        }else{
            return '';
        }
    }

    function getExcept1(){
        $this->db->select($this->selectDefault,FALSE);
        $this->db->where("$this->alias.status = true AND $this->alias.id != 1");
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if ($query->num_rows > 0){
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
        if ($query->num_rows > 0){
            return $query;
        }else{
            return '';
        }
    }


}