<?php
class mfiltro_tipo_propiedad extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "filtros_tipo_propiedad";
        $this->alias = 'ftp';

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".id_tipo_propiedad
            ,".$this->alias.".titulo
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";
    }
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.'.id', "desc");
        //$this->db->group_by($this->alias.'.titulo');
        $query = $this->db->get($this->table.' AS '.$this->alias);
        return $query;
    }

    function getAllByActive(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        return $query;
    }

    function getById($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.id' => $id, $this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }
        return 0;
    }

    function getByIdPropiedad($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.id_tipo_propiedad' => $id, $this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.'.id', "desc");
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }
        return 0;
    }

    function getByIdIn($ids){
        //$arr_where_in = "'" . join(', ',$ids) . "'"; 

        $this->db->select($this->selectDefault,FALSE);
        $this->db->where_in($this->alias.'.id',$ids);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }
        return 0;
    }

    function getDistinct(){
        //$this->db->distinct();
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.'.id', "desc");
        $this->db->group_by($this->alias.'.titulo');
        $query = $this->db->get($this->table.' AS '.$this->alias);
        return $query;
    }


}