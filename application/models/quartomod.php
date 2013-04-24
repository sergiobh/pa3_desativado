<?php
class QuartoMod extends CI_Model{
    
    public $QuartoId;
    public $Andar;
    public $Identificacao;
    public $Status;


    public function Listar(){
        $sql    = "
                    SELECT
                        Q.QuartoId
                        ,Q.Andar
                        ,Q.Identificacao AS Quarto        
                        ,IF(Q.Status = 0, 'Desativado',  'Ativo') AS Status
                    FROM
                        quarto Q
                    ORDER BY
                        Q.Andar
                        ,Q.Identificacao
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