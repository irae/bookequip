
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	
	<title>BookEquip - Acesso Restrito</title> 
	
    <style type="text/css" media="all"> 
		@import url("/css/style.css");
    </style> 
	
	<!--[if lt IE 8]><style type="text/css" media="all">@import url("css/ie.css");</style><![endif]--> 
 
</head> 
 
 
 
 
<body> 
	
	<div id="hld"> 
	
		<div class="wrapper">		<!-- wrapper begins --> 

			<div class="block small center login"> 
			
				<div class="block_head"> 
					<div class="bheadl"></div> 
					<div class="bheadr"></div> 
					
					<h2>Login</h2> 
					<ul> 
						<li><a href="/">Voltar ao site</a></li> 
					</ul> 
				</div>		<!-- .block_head ends --> 
				
				
				
				
				<div class="block_content"> 
					
					<?php if (!is_null($form['username']->getError())) echo '<div class="message errormsg"><p>Usuário e/ou senha incorreto(s)</p></div>' ?>
					<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">

					<p>
					<?php echo $form['username']->renderLabel(); ?>
					<?php echo $form['username']->render(array('class' => 'text small')); ?>
					</p>

					<p>
					<?php echo $form['password']->renderLabel(); ?>
					<?php echo $form['password']->render(array('class' => 'text small')); ?>
					</p>

					<p><label>Remember me 
					<?php echo $form['remember']->render(); ?></label>
					</p>

					<?php echo $form['_csrf_token']; ?>

					          <p><input type="submit" value="Login" class="submit mid" /></p>

					          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
					          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
					            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
					          <?php endif; ?>
					</form>
					
				</div>		<!-- .block_content ends --> 
					
				<div class="bendl"></div> 
				<div class="bendr"></div> 
								
			</div>		<!-- .login ends --> 
		
		</div>						<!-- wrapper ends --> 
		
	</div>		<!-- #hld ends --> 
	
	
	<!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->	
	<script type="text/javascript" src="/js/jquery.js"></script> 
	<script type="text/javascript" src="/js/jquery.img.preload.js"></script> 
	<script type="text/javascript" src="/js/facebox.js"></script> 
	<script type="text/javascript" src="/js/jquery.pngfix.js"></script> 
	<script type="text/javascript" src="/js/custom.js"></script> 
	
	
</body> 
</html>
	
