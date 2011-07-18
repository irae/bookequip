<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>    
	
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include_title() ?>
    <style type="text/css" media="all">
		@import url("/css/style.css");
		@import url("/css/jquery.wysiwyg.css");
		@import url("/css/facebox.css");
		@import url("/css/visualize.css");
		@import url("/css/date_input.css");
    </style>
	<!--[if lt IE 8]><style type="text/css" media="all">@import url("/css/ie.css");</style><![endif]-->
	
</head>

<body>
	
	<div id="hld">
	
		<div class="wrapper">		<!-- wrapper begins -->
	
	
			
			<div id="header">
				<div class="hdrl"></div>
				<div class="hdrr"></div>
				
				<h1><a href="#">Book_Equip</a></h1>
				
				<ul id="nav">
					<li><a href="<?php echo url_for('calendario/index'); ?>">Calendário</a></li>
					<li><a href="#">Equipamentos</a></li>
					<li><a href="<?php echo url_for('agendamento/index'); ?>">Agendamentos</a>
						<?php if (sfContext::getInstance()->getUser()->getGuardUser()): ?>
						<ul>
							<li><a href="<?php echo url_for('agendamento/novo'); ?>">Novo agendamento</a></li>
						</ul>
						<?php endif; ?>
					</li>
					<?php if ($sf_user->isAuthenticated() && $sf_user->hasGroup('admin')): ?>
						<li><a href="#">Administração</a>
							<ul>
								<li><a href="<?php echo url_for('agendamento/agendarUsuario') ?>">Agendar para usuário</a></li>
								<li><a href="<?php echo url_for('pendenciasUsuario/index') ?>">Pendências cadastrais</a></li>
							</ul>
						</li>
						
					<?php endif; ?>
				</ul>
				
				<?php if ($sf_user->isAuthenticated()): ?>
					<?php if (!is_null($sf_user->getGuardUser()->getProfileFirstName())): ?>
					<p class="user">Olá, <a href="<?php echo url_for('editar_cadastro') ?>"><?php echo $sf_user->getGuardUser()->getProfileFirstName(); ?></a>
					<?php endif; ?>	
					| <a href="<?php echo url_for('@sf_guard_signout') ?>">Logout</a></p>
				<?php else: ?>
					<p class="user"><a href="<?php echo url_for('@sf_guard_signin') ?>">Fazer login</a></p>
				<?php endif; ?>
			</div>		<!-- #header ends -->
			
		
			<?php echo $sf_content ?>

			<div id="footer">
			
				<p class="left"><a href="#">bookequip.ajudae.com</a></p>
				<p class="right">2011</p>
				
			</div>
		
		
		</div>						<!-- wrapper ends -->
		
	</div>		<!-- #hld ends -->
	
	
	<!--[if IE]><script type="text/javascript" src="/js/excanvas.js"></script><![endif]-->	
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.img.preload.js"></script>
	<script type="text/javascript" src="/js/jquery.filestyle.mini.js"></script>
	<script type="text/javascript" src="/js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="/js/jquery.date_input.pack.js"></script>
	<script type="text/javascript" src="/js/facebox.js"></script>
	<script type="text/javascript" src="/js/jquery.visualize.js"></script>
	<script type="text/javascript" src="/js/jquery.visualize.tooltip.js"></script>
	<script type="text/javascript" src="/js/jquery.select_skin.js"></script>
	<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="/js/ajaxupload.js"></script>
	<script type="text/javascript" src="/js/jquery.pngfix.js"></script>
	<script type="text/javascript" src="/js/custom.js"></script>
	<script type="text/javascript" src="/js/bookequip.js"></script>
	
</body>
</html>