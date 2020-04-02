<?php
class Categoria extends Model {
    public function getCategorias(){
        $sql = $this->db->query('SELECT * FROM categorias');
        $sql = $sql->fetchAll();
        return $sql;
    }
}
?>