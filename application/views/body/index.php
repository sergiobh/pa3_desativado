<!--enrique-->
<?php
	$LibHeader 			= 'libraries/header';
	$LibFooter 			= 'libraries/footer';

	$Header				= 'body/header';
	$Menu				= 'body/menu';
	$Footer 			= 'body/footer';
?>
<?php $this->load->view($LibHeader);?>
	<div class='middle'>
		<?php $this->load->view($Header);?>
		<?php $this->load->view($Menu);?>
        <div class='container'>
            <?php $this->load->view($View);?>
		</div>
        <?php $this->load->view($Footer);?>
	</div>
<?php $this->load->view($LibFooter);?>