<?php
class QuartoMod extends CI_Model{
    
    public $QuartoId;
    public $Andar;
    public $Identificacao;
    public $Status;
    public $Ocupacao;

    public function Listar(){
        $sql    = "
                    SELECT
                        Q.QuartoId
                        ,Q.Andar
                        ,Q.Identificacao AS Quarto
                        ,IF(Q.Status = '1', IF(O.LeitoId IS NULL, 'Ativo', 'Ocupado'), 'Desativado' ) AS Status
                    FROM
                        quarto Q
                        LEFT JOIN leito L ON L.QuartoId = Q.QuartoId
                        LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                    GROUP BY
                        Q.QuartoId  
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

    public function getAndar(){
        $sql_column    = '';
        $sql_from      = '';
        $sql_where     = '';
        $sql_having    = '';

        if($this->Ocupacao == 1 && is_numeric($this->PacienteId)){

            $this->load->model('PacienteMod');
            $this->PacienteMod->PacienteId      = $this->PacienteId;
            $Paciente                           = $this->PacienteMod->getDadosPaciente();

            if($Paciente){
                $sql_column     = "
                                    ,L.QuartoId
                                    ,COUNT(L.LeitoId) AS QtdLeitos
                                    ,GROUP_CONCAT(L.LeitoId) AS Leitos
                                    ";

                $sql_from       = "
                                    INNER JOIN leito L ON L.QuartoId = Q.QuartoId
                                    LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                                    ";

                $sql_where      = "
                                    WHERE
                                        Q.Status = 1
                                        AND L.Status != 0
                                    ";

                $sql_group_by   = "
                                    L.QuartoId
                                    ,Q.Andar
                                    ";

                if($Paciente->Tipo == 1){
                    $sql_having     = "
                                        HAVING
                                            QtdLeitos = 1
                                        ";
                }
            }
            else{
                // Retornar inválido!
                return false;
            }
        }
        else{
            $sql_group_by       = "Q.Andar";
        }

        $sql    = "
                    SELECT
                        Q.Andar
                        ".$sql_column."
                    FROM
                        quarto Q
                        ".$sql_from."
                    ".$sql_where."
                    GROUP BY
                        ".$sql_group_by."
                    ".$sql_having."
                    ORDER BY
                        Q.Andar
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) > 0){
            $Retorno        = '';
            $Ultimo         = '';

            // Verifica se possui mais de um Andar
            foreach ($dados as $key => $value) {
                if($Ultimo != $value->Andar){
                    $Retorno[]      = $value;

                    $Ultimo         = $value->Andar;
                }
            }

            return $Retorno;
        }
        else{
            return false;
        }
    }

    public function getQuartos(){
        $this->Andar    = trim($this->Andar);

        if($this->Andar == ''){
            return false;
        }

        $sql_column    = '';
        $sql_from      = '';
        $sql_where     = '';
        $sql_having    = '';

        if($this->Ocupacao == 1 && is_numeric($this->PacienteId)){

            $this->load->model('PacienteMod');
            $this->PacienteMod->PacienteId      = $this->PacienteId;
            $Paciente                           = $this->PacienteMod->getDadosPaciente();

            if($Paciente){
                $sql_column     = "
                                    ,O.LeitoId AS Ocupacao
                                    ";

                $sql_having     = "
                                    HAVING
                                        O.LeitoId IS NULL
                                    ";

                $sql_from       = "
                                    INNER JOIN leito L ON L.QuartoId = Q.QuartoId
                                    LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                                    ";

                $sql_where      = "
                                    AND Q.Status = 1
                                    AND L.Status = 1
                                    ";
            }
            else{
                // Retornar inválido!
                return false;
            }
        }



        $sql    = "
                    SELECT
                        Q.QuartoId
                        ,Q.Identificacao AS Quarto
                        ".$sql_column."
                    FROM
                        quarto Q
                        ".$sql_from."
                    WHERE
                        Q.Andar = '".$this->Andar."'
                        ".$sql_where."
                    GROUP BY
                        Q.QuartoId
                    ".$sql_having."
                    ORDER BY
                        Quarto
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) > 0){
            if($this->Ocupacao == 1 && is_numeric($this->PacienteId)){
                // Apartamento
                /*
                /* Regra só pode ter um leito no quarto ativo e disponivel
                */
                if($Paciente->Tipo == 1){
                    

                    //echo 'Tipo 1';


                }
                // Enfermaria
                /*
                /* Regra ter leito no quarto ativo e disponivel
                */
                else if($Paciente->Tipo == 2){
                    

                    //echo 'Tipo 2';


                }

// deletar
                return $dados;
            }
            else{
                return $dados;
            }
        }
        else{
            return false;
        }
    }

    public function setQuarto(){

        $this->Andar            = trim($this->Andar);
        $this->Identificacao    = trim($this->Identificacao);

        if($this->Andar == '' || $this->Identificacao == ''){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }


        // Se não existir poderá ser adicionado
        if(! $this->existQuarto()){
            
            $sql        = "
                            INSERT INTO
                            quarto (
                                Andar
                                ,Identificacao
                            )
                            VALUES(
                                '".$this->Andar."'
                                ,'".$this->Identificacao."'
                            )";

            $this->db->query($sql);

            if($this->db->affected_rows() > 0){
                echo '{"success": true, "msg": "Dados salvos com sucesso!" }';
            }
            else{
                echo '{"success": false, "msg": "Ocorreu um erro ao salvar, tente novamente!" }';
            }
        }
        else{
            echo '{"success": false, "msg": "Quarto existente para este andar!" }';
            exit;
        }
    }

    public function existQuarto(){
        if($this->Andar == '' || $this->Identificacao == ''){
            return false;
        }

        $sql  = "
                SELECT
                    QuartoId
                FROM
                    quarto Q
                WHERE
                    Q.Andar = '".$this->Andar."'
                    AND Q.Identificacao = '".$this->Identificacao."'
                ";

        $query  = $this->db->query($sql);

        $dados = $query->row();

        if(is_object($dados)){
            return true;
        }
        else{
            return false;
        }
    }

    public function getQuarto(){
        if(!is_numeric($this->QuartoId)){
            return false;
        }


        $sql  = "
                SELECT
                    Q.QuartoId
                    ,Q.Andar
                    ,Q.Identificacao
                    ,IF(Q.Status = '1', IF(O.LeitoId IS NULL, '1', '3'), Q.Status ) AS Status
                FROM
                    quarto Q
                    LEFT JOIN leito L ON L.QuartoId = Q.QuartoId
                    LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                WHERE
                    Q.QuartoId = ".$this->QuartoId."
                ";

        $query  = $this->db->query($sql);

        $dados = $query->row();

        if(is_object($dados)){
            return $dados;
        }
        else{
            return false;
        }
    }

    public function setEdicao(){

        if(! is_numeric($this->QuartoId)){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }

        $this->Identificacao    = trim($this->Identificacao);

        if($this->Identificacao == '' || !is_numeric($this->Status)){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }

        // Se não existir poderá ser adicionado
        if(! $this->existQuarto()){

            // tratamento de status
            $sql_status = '';

            $sql_status = ",Status = ".$this->Status;
            
            $sql        = "
                            UPDATE 
                                quarto 
                            SET
                                Identificacao = '".$this->Identificacao."'
                                ".$sql_status."
                            WHERE
                                QuartoId = ".$this->QuartoId."
                            ";

            $this->db->query($sql);

            if($this->db->affected_rows() > 0){
                echo '{"success": true, "msg": "Dados salvos com sucesso!" }';
            }
            else{
                echo '{"success": false, "msg": "Altere pelo menos um dos campos!" }';
            }
        }
        else{
            echo '{"success": false, "msg": "Leito existente para este quarto!" }';
            exit;
        }
    }

    public function getStatusAll(){
        $Item->Status   = 0;
        $Item->Nome     = 'Desativado';
        $Status[]       = $Item;

        unset($Item);
        $Item->Status   = 1;
        $Item->Nome     = 'Ativo';
        $Status[]       = $Item;

        return $Status;
    }
}
?>