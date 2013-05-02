<?php
class PacienteMod extends CI_Model{
    
    public $OcupacaoId;
    public $PacienteId;
    public $Nome;
    public $Cpf;
    public $Logradouro;
    public $Numero;
    public $Complemento;
    public $Bairro;
    public $Cidade;
    public $Estado;
    public $Tipo;
    public $Status;
    public $DataHora;

    public function Listar(){
        $sql    = "
                    SELECT
                        P.PacienteId
                        ,Q.Identificacao AS Quarto
                        ,L.Identificacao AS Leito
                        ,P.Nome AS Paciente
                        ,F.Nome AS FuncCadastro
                        ,DATE_FORMAT(O.DataCad,'%d/%m/%Y') AS DataCad
                        ,DATE_FORMAT(O.HoraCad,'%H:%i') AS HoraCad
                    FROM
                        ocupacao O
                        INNER JOIN paciente P ON P.PacienteId = O.PacienteId
                        INNER JOIN leito L ON L.LeitoId = O.LeitoId
                        INNER JOIN quarto Q ON Q.QuartoId = L.QuartoId
                        INNER JOIN funcionario F ON F.FuncionarioId = O.FuncCadastro
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

    function FilaEspera(){
        $sql    = "
                    SELECT
                        P.PacienteId
                        ,P.Nome AS Paciente
                        ,P.DataHora
                    FROM
                        paciente P
                    WHERE
                        P.Status = 1
                        AND P.PacienteId NOT IN (
                            SELECT
                                O.PacienteId
                            FROM
                                ocupacao O
                            WHERE
                                O.FuncBaixa IS NULL
                        )
                    ORDER BY
                        P.DataHora
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