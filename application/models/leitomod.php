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

    public function getLeito(){
        if(!is_numeric($this->QuartoId) || $this->Identificacao == ''){
            return false;
        }


        $sql  = "
                SELECT
                    LeitoId
                FROM
                    leito L
                WHERE
                    L.Identificacao = '".$this->Identificacao."'
                    AND L.QuartoId = ".$this->QuartoId."
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

    public function setLeito(){

        if(! is_numeric($this->QuartoId)){
            echo '"success": false, "msg": "Favor recarregar a página!"';
            exit;
        }

        $this->Identificacao    = trim($this->Identificacao);

        if($this->Identificacao == ''){
            echo '"success": false, "msg": "Favor recarregar a página!"';
            exit;
        }


        // Se não existir poderá ser adicionado
        if(! $this->getLeito()){
            
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
}
?>