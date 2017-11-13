<?php
class mamenidad extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "amenidades";
        $this->alias = 'a';

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
        $this->db->order_by($this->alias.'.id', "desc");
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return 0;
        }
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
        $arrayWhere = array($this->alias.'.id' => $id);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }
        return 0;
    }

    function getByIdIn($ids){
        //$arr_where_in = "'" . join(', ',$ids) . "'"; 
        if ($ids != ''){
            $query = $this->db->query("
                    SELECT a.id
                    ,a.titulo
                    ,a.status
                    FROM amenidades as a
                    WHERE id IN (".$ids.")
                    ORDER BY a.id ASC
                ");

    /*        $this->db->select($this->selectDefault,FALSE);
            $this->db->where_in($this->alias.'.id',$ids);
            $query = $this->db->get($this->table.' AS '.$this->alias);*/
            if($query->num_rows()>0){
                return $query;
            }
        }
        return 0;
    }    

}