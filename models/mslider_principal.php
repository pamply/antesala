<?php
class mslider_principal extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "slider_principal";
        $this->alias = 's';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".titulo
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".link
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".titulo
           ,".$this->alias.".titulo_2
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".foto_2
            ,".$this->alias.".thumbnail_2
            ,".$this->alias.".link
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";
    }
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.'.id', "desc");
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


}