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

    public function BaixaOcupacao(){
        if($this->OcupacaoId == ''){
            echo '{"success": false, "msg": "Favor recarregar a página!" }';
            exit;
        }

        $FuncBaixa      = 1;
        $DataBaixa      = date('Y-m-d');
        $HoraBaixa      = date('H:i:s');

        //$FuncBaixa              = $_SESSION[];
        $sql    = "
                    SELECT
                        O.PacienteId
                    FROM
                        ocupacao O
                    WHERE
                        O.FuncBaixa IS NULL
                        AND O.OcupacaoId = ".$this->OcupacaoId."
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) <= 0){
            echo '{"success": false, "msg": "Favor recarregar a página!" }';
            exit;
        }

        $PacienteId             = $dados[0]->PacienteId;


        $sql    = "
                    UPDATE
                        ocupacao O
                    SET
                        O.FuncBaixa = ".$FuncBaixa."
                        ,O.DataBaixa = '".$DataBaixa."'
                        ,O.HoraBaixa = '".$HoraBaixa."'
                    WHERE
                        O.FuncBaixa IS NULL
                        AND O.OcupacaoId = ".$this->OcupacaoId."
                    ";

        $query  = $this->db->query($sql);

        if($this->db->affected_rows() > 0){
            echo '{"success": true, "PacienteId": "'.$PacienteId.'" }';
        }
        else{
            echo '{"success": false, "msg": "Ocorreu um erro ao efetuar a baixa! Favor recarregar a página!" }';
        }
    }
}
?>