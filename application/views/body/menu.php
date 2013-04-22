<?php
    $Tabindex = 1;
?>
<div class='menu_header'>
    <div class='menu_content'>
        <a href="<?php echo BASE_URL;?>" tabindex='<?php echo $Tabindex++;?>'>
            <div class='botao menu_body'>
                <div class='menu_text'>Home</div>
            </div>
        </a>   

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>A Empresa</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>/sghh/historia">
                        <div class='submenu_item submenu_primeiro'>História</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/sghh/objetivos">
                        <div class='submenu_item'>Objetivos</div>
                    </a>
                </div>
            </div>
        </div>

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Empresas</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>/empresa/abc">
                        <div class='submenu_item submenu_primeiro'>Abc...</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/empresa/def">
                        <div class='submenu_item'>Def...</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/empresa/ghi">
                        <div class='submenu_item'>Ghi..</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/empresa/jkl">
                        <div class='submenu_item'>Jkl...</div>
                    </a>
                </div>
            </div>
        </div>

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Candidatos</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <div class='submenu_containt'>
                    <a href="<?php echo BASE_URL;?>/candidato/biblioteca">
                        <div class='submenu_item submenu_primeiro'>Curriculo</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/candidato/abc">
                        <div class='submenu_item'>Abc...</div>
                    </a>

                    <a href="<?php echo BASE_URL;?>/candidato/def">
                        <div class='submenu_item'>Def...</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/candidato/ghi">
                        <div class='submenu_item'>Ghi...</div>
                    </a>
                    <a href="<?php echo BASE_URL;?>/candidato/jkl">
                        <div class='submenu_item submenu_ultimo'>Jkl...</div>
                    </a>
                </div>
            </div>
        </div>

        <div class='botao menu_body' tabindex='<?php echo $Tabindex++;?>' submenu_portal='menu<?php echo $Tabindex;?>'>
            <div class='menu_text'>Portal</div>
            <div class='submenu menu<?php echo $Tabindex;?>'>
                <br/>aqui vai vir os inputs e quando o usuário estiver logado deverá ter um link para o Admin
            </div>
        </div>

        <a href="<?php echo BASE_URL;?>/ondeestamos" tabindex='<?php echo $Tabindex++;?>'>
            <div class='botao menu_body'>
                <div class='menu_text'>Onde estamos</div>
            </div>
        </a>

        <a href="<?php echo BASE_URL;?>/faleconosco" tabindex='<?php echo $Tabindex++;?>'>
            <div class='botao menu_body'>
                <div class='menu_text'>Fale Conosco</div>
            </div>
        </a>
    </div>
</div>