<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>    
	
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include_title() ?>
    <style type="text/css" media="all">
		@import url("/css/style.css");
		@import url("/sf/sf_admin/css/main.css");
		@import url("/sf/sf_admin/css/default.css");
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
				
				<h1><a href="#">Agendamento Multiusuário</a></h1>
				
				<ul id="nav">
					<li><a href="/">Calendário</a></li>
					<li><a href="#">Equipamentos</a></li>
					<?php if ($sf_user->isAuthenticated() && $sf_user->hasGroup('admin')): ?>
						<li><a href="#">Administração</a>
							<ul>
								<li><a href="/calendario/sync">Sincronizar Calendário</a></li>
								<li><a href="/agendamento/agendar-para-usuario">Agendar para usuário</a></li>
								<li><a href="/pendencias-cadastrais">Pendências cadastrais</a></li>
								<li><a href="/backend.php/equipamento">Equipamentos</a></li>
								<li><a href="/backend.php/horario">Horários de agendamento</a></li>
								<li><a href="/backend.php/usuario">Usuários</a></li>
								<li><a href="/backend.php/agendamento">Agendamentos</a></li>
								
							</ul>
						</li>
						
					<?php endif; ?>
				</ul>
				
				<?php if ($sf_user->isAuthenticated()): ?>
					<?php if (!is_null($sf_user->getGuardUser()->getProfileFirstName())): ?>
					<p class="user">Olá, <a href="/meu-perfil"><?php echo $sf_user->getGuardUser()->getProfileFirstName(); ?></a>
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