<?php
class PacienteMod extends CI_Model{
    
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

    public function getPaciente(){
        if($this->PacienteId == ''){
            return false;
        }

        $sql    = "
                    SELECT
                        *
                    FROM
                        paciente
                    WHERE
                        PacienteId = ".$this->PacienteId."
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

    public function getCpfExiste(){
        if($this->Cpf == ''){
            return false;
        }

        $sql    = "
                    SELECT
                        *
                    FROM
                        paciente
                    WHERE
                        Cpf = ".$this->Cpf."
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->row();

        if(is_object($dados)){
            // Cpf já existe
            return false;
        }
        else{
            // Cpf não existe
            return true;
        }
    }

    public function setPaciente(){
        if($this->Nome == '' || $this->Cpf == '' || !is_numeric($this->Cpf) || $this->Tipo == ''){
            echo '{success: false, "reload": true, "campo": ""}';
            exit;
        }

        $Paciente    = $this->getCpfExiste();

        if($Paciente){

            $DataHora           = date('Y-m-d');

            $sql    = "
                        INSERT INTO
                            site
                                (
                                    Nome
                                    ,Cpf
                                    ,Logradouro
                                    ,Numero
                                    ,Complemento
                                    ,Bairro
                                    ,Cidade
                                    ,Estado
                                    ,Tipo
                                    ,Status
                                    ,DataHora
                                )
                            VALUES
                                (
                                    '".$this->Nome."'
                                    ,'".$this->Cpf."'
                                    ,'".$this->Logradouro."'
                                    ,'".$this->Complemento."'
                                    ,'".$this->Bairro."'
                                    ,'".$this->Cidade."'
                                    ,'".$this->Estado."'
                                    ,'".$this->Tipo."'
                                    ,1
                                    ,'".$DataHora."'
                                )
                        ";
echo '<pre>'.$sql;exit;
            $this->db->query($sql);

            if($this->db->affected_rows() > 0){
                return '{success: true, "msg": "Paciente cadastrado com sucesso!", "campo": ""}';
            }
            else{
                return "{success: false, 'msg': 'Ocorreu um erro ao cadastrar o paciente, favor recarregar a página!', 'campo' : 'Nome'}";
            }
        }
        else{
            return "{success: false, 'msg': 'Cpf do paciente já cadastrado', 'campo' : 'Cpf'}";
        }
    }

    public function saveEdit(){
        if(!is_numeric($this->SiteId) || $this->SiteId == '' || $this->Nome == ''){
            echo '{success: false, "reload": true, "campo": ""}';
        }

        $sql    = "
                    UPDATE
                        site
                    SET
                        Nome = '".$this->Nome."'
                    WHERE
                        SiteId = ".$this->SiteId."
                    ";
        $this->db->query($sql);

        if($this->db->affected_rows() > 0){
            return '{success: true, "msg": "Site atualizado com sucesso!", "campo": ""}';
        }
        else{
            return "{success: false, 'msg': 'Ocorreu um erro ao atualizar o site, favor recarregar a página!', 'campo' : 'Nome'}";
        }
    }

    public function getSites(){
        if($this->Page == ''){
            $this->Page = 1;
        }

        $sql_order = '';
        if($this->Sort != ''){
            $Sort       = json_decode($this->Sort);
            $Column     = $Sort[0]->property;
            $Ordem      = $Sort[0]->direction;

            $ColumnPermitidas = array(
                                        "Nome"
                                    );

            if(in_array($Column, $ColumnPermitidas) && ($Ordem == "ASC" || $Ordem == "DESC")){
                $sql_order  = " ORDER BY ".$Column." ".$Ordem." ";
            }
        }

        $limit      = ($this->Page-1) * PAGINACAO_GRID;
        $sql_limit  = "LIMIT ".$limit.",".PAGINACAO_GRID;


        $sql    = "
                    SELECT
                        SQL_CALC_FOUND_ROWS
                        SiteId
                        ,Nome
                    FROM
                        site
                    ".$sql_order."
                    ".$sql_limit."
                    ";

        $query  = $this->db->query($sql);

        $dados = $query->result();

        if(count($dados) > 0){
            $retorno->registros = $dados;

            // Total de registros p/ a paginação do grid            
            $sql    = "
                        SELECT FOUND_ROWS() AS totalRegistros
                        ";
            $query  = $this->db->query($sql);
            $dados = $query->row();

            $retorno->totalRegistros = $dados->totalRegistros;

            return json_encode($retorno);
        }
        else{
            return false;
        }
    }

    public function getListaSites(){
        $sql    = "
                    SELECT
                        SiteId
                        ,Nome
                        ,Dominio
                    FROM
                        site
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

    public function getEditSite(){
        if($this->SiteId == '' && !is_numeric($this->SiteId)){
            return false;
        }

        $sql    = "
                    SELECT
                        SiteId
                        ,Nome
                    FROM
                        site
                    WHERE
                        SiteId = ".$this->SiteId."
                    ";

        $query  = $this->db->query($sql);

        $dado = $query->row();

        if(is_object($dado)){
            return $dado;
        }
        else{
            return false;
        }
    }
}
?>