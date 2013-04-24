<?php
class FuncionarioMod extends CI_Model{
    
    public $FuncionarioId;
    public $Nome;
    public $Cpf;
    public $Senha;

    public function Listar(){
        $sql    = "
                    SELECT
                        F.FuncionarioId
                        ,F.Nome
                        ,F.Cpf
                    FROM
                        funcionario F
                    ORDER BY
                        F.Nome
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