<?php
class PacienteMod extends CI_Model{
    
    public $OcupacaoId;
    public $PacienteId;
    public $Nome;
    public $Sexo;
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
    public $Telefone;

    public function Listar(){
        $sql    = "
                    SELECT
                        O.OcupacaoId
                        ,Q.Identificacao AS Quarto
                        ,Q.Andar
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

    public function getPaciente($Externo = true){
        if(!is_numeric($this->Cpf)){            
            if($Externo){
                echo '{"success": false, "msg": "Favor recarregar a página!" }';
                exit;
            }
            else{
                return false;
            }
        }

        $sql    = "
                    SELECT
                        P.PacienteId
                    FROM
                        paciente P
                    WHERE
                        P.Cpf = ".$this->Cpf."
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) > 0){
            if($Externo){
                echo '{"success": true, "url": "editar", "PacienteId": '.$dados[0]->PacienteId.', "msg": "Redirecionando para os dados do Paciente!" }';
                exit;
            }
            else{
                return true;
            }
        }
        else{
            if($Externo){
                echo '{"success": true, "url": "cadastro", "msg": "Redirecionando para o cadastro de Paciente!" }';
                exit;
            }
            else{
                return false;
            }
        }
    }

    public function getDadosPaciente(){
        if(!is_numeric($this->PacienteId)){
            return false;
        }

        $sql    = "
                    SELECT
                        P.*
                        ,GROUP_CONCAT(Telefone) AS TelefonesAgrupados
                    FROM
                        paciente P
                        LEFT JOIN telefone T ON T.PacienteId = P.PacienteId
                    WHERE
                        P.PacienteId = '".$this->PacienteId."'
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) > 0){
            $Telefones              = explode(',', $dados[0]->TelefonesAgrupados);

            unset($dados[0]->TelefonesAgrupados);

            $dados[0]->Telefones    = $Telefones;

            $dados[0]->Cpf          = $this->setMascaraCpf($dados[0]->Cpf);

            return $dados[0];
        }
        else{
            return false;
        }
    }

    private function setMascaraCpf($Cpf){
        return substr($Cpf, 0, 3).'.'.substr($Cpf, 3, 3).'.'.substr($Cpf, 6, 3).'-'.substr($Cpf, -2);
    }

    public function SalvarCadastro(){
        if($this->getPaciente(false)){
            echo '{"success": false, "msg": "Paciente já cadastrado!" }';
            exit;
        }

        $sql    = "
                    INSERT INTO
                    paciente(
                        Nome
                        ,Sexo
                        ,Cpf
                        ,Logradouro
                        ,Numero
                        ,Complemento
                        ,Bairro
                        ,Cidade
                        ,Estado
                        ,Tipo
                        ,DataHora
                    )
                    VALUES(
                        '".$this->Nome."'
                        ,'".$this->Sexo."'
                        ,'".$this->Cpf."'
                        ,'".$this->Logradouro."'
                        ,'".$this->Numero."'
                        ,'".$this->Complemento."'
                        ,'".$this->Bairro."'
                        ,'".$this->Cidade."'
                        ,'".$this->Estado."'
                        ,'".$this->Tipo."'
                        ,NOW()
                    )";

        $this->db->query($sql);

        if($this->db->affected_rows() > 0){
            $this->PacienteId = $this->db->insert_id();

            // Grava telefone
            $this->setTelefone();

            echo '{"success": true, "PacienteId": "'.$this->PacienteId.'", "msg": "Paciente já cadastrado!" }';
        }
        else{
            echo '{"success": false, "msg": "Favor recarregar a página!" }';
        }
    }

    public function setTelefone(){
        $Telefones          = explode(',', $this->Telefone);

        foreach ($Telefones as $key => $Telefone) {
            $sql    = "
                        INSERT INTO
                        telefone(
                            PacienteId
                            ,Telefone
                        )
                        VALUES(
                            '".$this->PacienteId."'
                            ,'".$Telefone."'
                        )";            

            $this->db->query($sql);
        }
    }

    public function delTelefone(){
        $sql    = "
                    DELETE
                    FROM
                        telefone
                    WHERE
                        PacienteId = '".$this->PacienteId."'
                ";

        $this->db->query($sql);
    }

    public function SalvarEdicao(){
        $sql    = "
                    UPDATE
                        paciente
                    SET
                        Nome = '".$this->Nome."'
                        ,Sexo = '".$this->Sexo."'
                        ,Cpf = '".$this->Cpf."'
                        ,Logradouro = '".$this->Logradouro."'
                        ,Numero = '".$this->Numero."'
                        ,Complemento = '".$this->Complemento."'
                        ,Bairro = '".$this->Bairro."'
                        ,Cidade = '".$this->Cidade."'
                        ,Estado = '".$this->Estado."'
                        ,Tipo = '".$this->Tipo."'
                        ,DataHora = NOW()
                    WHERE
                        PacienteId = '".$this->PacienteId."'
                    ";

        $this->db->query($sql);

        // Deleta todos telefones p/ inseri-los novamente
        $this->delTelefone();

        // Grava telefone
        $this->setTelefone();

        echo '{"success": true, "msg": "Paciente salvo com sucesso!" }';
    }

    public function EfetuaBaixa(){
        if($this->PacienteId == ''){
            echo '{"success": false, "msg": "Favor recarregar a página!" }';
            exit;
        }

        $sql    = "
                    UPDATE
                        paciente
                    SET
                        Status = 0
                    WHERE
                        PacienteId = '".$this->PacienteId."'
                    ";

        $this->db->query($sql);

        if($this->db->affected_rows() > 0){
            echo '{"success": true, "msg": "Paciente liberado para a auta!" }';
        }
        else{
            echo '{"success": false, "msg": "Ocorreu um erro ao efetuar a baixa. Edite o Paciente!" }';
        }
    }
}
?>