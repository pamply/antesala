<?php
class mnewsletter extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "newsletter";
        $this->alias = 'e';

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".nombre
            ,".$this->alias.".correo
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";;
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
    function checkMail($correo){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.correo' => $correo);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }

    }


}