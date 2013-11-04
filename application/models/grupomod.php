<?php
class GrupoMod extends CI_Model{
    
    public $GrupoId;
    public $Nome;

    public function Listar(){
        $sql    = "
                    SELECT
                        G.GrupoId
                        ,G.Nome
                    FROM
                        grupo G
                    ORDER BY
                        G.Nome
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) > 0){
            return $dados;
        }
        else{
            return false;
        }
    }
}
?>