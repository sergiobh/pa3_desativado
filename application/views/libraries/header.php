<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<?php echo isset($_SERVER['HTTPS']) ? 'https://' : 'http://';?>www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<?php echo isset($_SERVER['HTTPS']) ? 'https://' : 'http://';?>www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR" xmlns:fb="<?php echo isset($_SERVER['HTTPS']) ? 'https://' : 'http://';?>ogp.me/ns/fb#">
	<head>
		<title><?php echo ((isset($Title_Page) && $Title_Page != '') ? $Title_Page : TITLE_PAGE);?></title>
		<link type="image/x-icon" href="<?php echo BASE_URL;?>/web/imagens/site/favicon.ico" rel="icon" />
		<link href="<?php echo BASE_URL;?>/web/imagens/site/favicon.ico" rel="shortcut icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta http-equiv="content-language" content="pt-BR" />		
        <link rel="stylesheet" href="<?php echo BASE_URL;?>/web/css/global.php" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo BASE_URL;?>/web/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL;?>/web/js/jquery/jquery.blockUI.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL;?>/web/js/jquery/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL;?>/web/js/global.php"></script>
		<?php
			if(isset($Script)){
				foreach ($Script as $Registro) {
					echo '<script type="text/javascript" src="'.BASE_URL.'/web/js/'.$Registro.'"></script>';
				}
			}
		?>
		<?php
			if(isset($Css)){
				foreach ($Css as $Registro) {
					echo '<link rel="stylesheet" href="'.BASE_URL.'/web/css/'.$Registro.'" type="text/css" media="screen" />';
				}
			}
		?>
	</head>
	<body>