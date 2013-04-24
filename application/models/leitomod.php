<?php
class LeitoMod extends CI_Model{
    
    public $LeitoId;
    public $QuartoId;
    public $Identificacao;
    public $Status;

    public function statusLeitos(){
        $sql    = "
                    SELECT
                        L.LeitoId
                        ,Q.Andar                
                        ,Q.Identificacao AS Quarto        
                        ,L.Identificacao AS Leito
                        ,IF(L.Status = '2', 'Arrumação', IF(O.LeitoId IS NULL, 'Liberado', 'Ocupado') ) AS Status
                    FROM
                        leito L
                        INNER JOIN quarto Q ON Q.QuartoId = L.QuartoId
                        LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                    WHERE
                        L.Status != 0
                        AND Q.Status = 1
                    ORDER BY
                        Q.Andar
                        ,Q.Identificacao
                        ,L.Identificacao
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

    public function Listar(){
        $sql    = "
                    SELECT
                        L.LeitoId
                        ,Q.Andar                
                        ,Q.Identificacao AS Quarto        
                        ,L.Identificacao AS Leito
                        ,IF(L.Status = '0', 'Desativado',  IF(L.Status = '2', 'Arrumação', IF(O.LeitoId IS NULL, 'Liberado', 'Ocupado') ) ) AS Status
                    FROM
                        leito L
                        INNER JOIN quarto Q ON Q.QuartoId = L.QuartoId
                        LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                    WHERE
                        Q.Status = 1
                    ORDER BY
                        Q.Andar
                        ,Q.Identificacao
                        ,L.Identificacao
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