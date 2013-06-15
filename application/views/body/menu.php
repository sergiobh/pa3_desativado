<?php
    $Tabindex = 1;
?>
<div class='menu_header'>
    <div class='menu_content'>
        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Leitos</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>">
                        <div class='submenu_item submenu_primeiro'>Painel de leitos</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/leito/cadastrar">
                        <div class='submenu_item'>Cadastrar</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/leito/listar">
                        <div class='submenu_item'>Listar</div>
                    </a>
                </div>
            </div>
        </div>

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Quartos</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>/quarto/cadastrar">
                        <div class='submenu_item submenu_primeiro'>Cadastrar</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/quarto/listar">
                        <div class='submenu_item'>Listar</div>
                    </a>
                </div>
            </div>
        </div>

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Pacientes</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>/paciente/painel">
                        <div class='submenu_item'>Painel de pacientes</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/paciente/cadastrar">
                        <div class='submenu_item'>Cadastrar pacientes</div>
                    </a>                    
                    
                    <a href="<?php echo BASE_URL;?>/paciente/consultar">
                        <div class='submenu_item submenu_primeiro'>Consultar</div>
                    </a>
                </div>
            </div>
        </div>

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Funcionários</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>/funcionario/cadastrar">
                        <div class='submenu_item'>Cadastrar</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/funcionario/listar">
                        <div class='submenu_item submenu_primeiro'>Listar</div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>