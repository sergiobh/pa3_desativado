<?php header('Content-type: text/css');?>
<?php define('BASE_IMG','http://'.$_SERVER['HTTP_HOST']);?>
<?php echo "/*";?><style><?php echo "*/\n";?>
html{
	background: none repeat scroll 0 0 #E1E1E5;
}
body{
    margin: 0;
	background: url('<?php echo BASE_IMG;?>/web/imagens/site/background.png') 50% top repeat-y;
}
.middle{
	overflow: visible !important;
	width: 999px;
	margin: 0 auto !important;
}
.middle .header{
	padding-top: 20px;
	margin: 0 370px 0 370px;
	position: relative;
	z-index: 100;
}
.middle .header .logo{
	background: url('<?php echo BASE_IMG;?>/web/imagens/site/logo.png') no-repeat;
	width: 260px;
	height: 80px;
}


<?php /*
/* Menu
*/ ?>
.middle .menu_header{
	background: url('<?php echo BASE_IMG;?>/web/imagens/site/menu_header.png') no-repeat;
	margin: -33px 0 0 44px;
	width: 911px;
	height: 180px;
	position: relative;
	z-index: 90;
}
.middle .menu_header .menu_content{
	padding: 54px 100px 0 100px;
}
.middle .menu_header .menu_content .botao{
	display: block;
	float: left;
	/*padding: 0 14px 0 14px;*/
	height: 78px;
}
.middle .menu_header .menu_content .botao.ativo{
	background: url('<?php echo BASE_IMG;?>/web/imagens/site/menu_ativo.png') no-repeat scroll right top transparent;
}
.middle .menu_header .menu_content .botao .menu_text{
	display: block;
	cursor: pointer;
	padding: 26px 37px 30px 37px;
	/*padding-top: 26px;*/
	font-family: "Lucida Grande","Lucida Sans Unicode","Helvetica","Arial","Verdana","sans-serif";
	font-size: 14px;
	color: #333333;
}

<?php /*
/* SubMenu
*/ ?>
.menu_header .submenu{
	display: none;
	position: absolute;
	/*width: 250px;*/
	/*margin-left: -14px;*/
	/*margin-top: 72px;*/
	/*padding-top: 72px;*/
	background-color: #F7F7F7;
	/*color: #56595E;*/
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}
.menu_header a,
.menu_header .submenu{
	color: #333333;
	text-decoration: none;
}
.menu_header .menu_body .submenu_item{
	/*padding-left: 10px;
	padding-right: 10px;*/
	padding: 7px 12px;
	border-top: 1px solid #D1D1D1;
	min-width: 140px;
}
.menu_header .menu_body .submenu_item.submenu_primeiro{
	-webkit-border-top-left-radius: 5px;
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topleft: 5px;
	-moz-border-radius-topright: 5px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	border-top: 0;
}
.menu_header .menu_body .submenu_item.submenu_ultimo{
	-webkit-border-bottom-right-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-moz-border-radius-bottomright: 5px;
	-moz-border-radius-bottomleft: 5px;
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
}
.menu_header .menu_body .submenu_item.item_ativo{
	background-color: #E1E1E1;/*#E9E9E9;*/
}



<?php /*
/* Clear
*/ ?>
.clear{
	clear: both;
}
.clear_left{
	clear: left;
}
.clear_right{
	clear: right;
}
.quebra_linha{
  word-wrap: break-word;
}
.hide{
	display: none;
}