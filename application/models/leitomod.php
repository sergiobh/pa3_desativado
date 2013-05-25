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
                        ,IF(L.Status = '2', 'Arrumacao', IF(O.LeitoId IS NULL, 'Liberado', 'Ocupado') ) AS Status
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
                        ,IF(L.Status = '0', 'Desativado',  IF(L.Status = '2', 'Arrumacao', IF(O.LeitoId IS NULL, 'Liberado', 'Ocupado') ) ) AS Status
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

    public function existLeito(){
        if(!is_numeric($this->QuartoId) || $this->Identificacao == ''){
            return false;
        }

        $sql_where      = '';

        if(is_numeric($this->LeitoId) && $this->LeitoId != ''){
            $sql_where = 'AND L.LeitoId != '.$this->LeitoId;
        }

        $sql  = "
                SELECT
                    LeitoId
                FROM
                    leito L
                WHERE
                    L.Identificacao = '".$this->Identificacao."'
                    AND L.QuartoId = ".$this->QuartoId."
                    ".$sql_where."
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

    public function getLeito(){
        if(!is_numeric($this->LeitoId)){
            return false;
        }


        $sql  = "
                SELECT
                    L.*
                    ,Q.Identificacao AS Quarto
                    ,Q.QuartoId
                    ,IF(L.Status = '1', IF(O.LeitoId IS NULL, '1', '3'), L.Status ) AS Status
                FROM
                    leito L
                    INNER JOIN quarto Q ON Q.QuartoId = L.QuartoId
                    LEFT JOIN ocupacao O ON O.LeitoId = L.LeitoId AND O.FuncBaixa IS NULL
                WHERE
                    L.LeitoId = ".$this->LeitoId."
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

    public function setLeito(){

        if(! is_numeric($this->QuartoId)){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }

        $this->Identificacao    = trim($this->Identificacao);

        if($this->Identificacao == ''){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }


        // Se não existir poderá ser adicionado
        if(! $this->existLeito()){
            
            $sql        = "
                            INSERT INTO
                            leito (
                                QuartoId
                                ,Identificacao
                            )
                            VALUES(
                                ".$this->QuartoId."
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
            echo '{"success": false, "msg": "Leito existente para este quarto!" }';
            exit;
        }
    }

    public function setEdicao(){

        if(! is_numeric($this->LeitoId)){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }

        $this->Identificacao    = trim($this->Identificacao);

        if($this->Identificacao == ''){
            echo '{"success": false, "msg": "Favor recarregar a página!"}';
            exit;
        }


        // Se não existir poderá ser adicionado
        if(! $this->existLeito()){
            
            $sql        = "
                            UPDATE 
                                leito 
                            SET
                                Identificacao = '".$this->Identificacao."'
                                ,Status = ".$this->Status."
                            WHERE
                                LeitoId = ".$this->LeitoId."
                                AND QuartoId = ".$this->QuartoId."
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

        unset($Item);
        $Item->Status   = 2;
        $Item->Nome     = 'Arrumação';
        $Status[]       = $Item;

        return $Status;
    }
}
?>