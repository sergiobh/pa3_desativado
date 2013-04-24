<?php
class OcupacaoMod extends CI_Model{
    
    public $OcupacaoId;
    public $PacienteId;
    public $LeitoId;
    public $FuncCadastro;
    public $DataCad;
    public $HoraCad;
    public $FuncBaixa;
    public $DataBaixa;
    public $HoraBaixa;

    public function ListarPacientes(){
        $sql    = "
                    SELECT
                        O.OcupacaoId
                        ,P.Nome AS Paciente
                    FROM
                        ocupacao O
                        INNER JOIN paciente P ON P.PacienteId = O.PacienteId
                    WHERE
                        O.FuncBaixa IS NULL
                    ORDER BY
                        P.Nome
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

    public function ListarLeitos(){
        $sql    = "
                    SELECT
                        O.OcupacaoId
                        ,CONCAT(Q.Identificacao, '/', L.Identificacao) AS Leito
                    FROM
                        ocupacao O
                        INNER JOIN leito L ON L.LeitoId = O.LeitoId
                        INNER JOIN quarto Q ON Q.QuartoId = L.QuartoId
                    WHERE
                        O.FuncBaixa IS NULL
                    ORDER BY
                        Q.Identificacao
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