<?php use_helper('I18N') ?>
<div class="block small left">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Login</h2>	
	</div>		<!-- .block_head ends -->
	
	
	
	<div class="block_content">
		<?php if ($sf_user->hasFlash('success_message')): ?>
		  <div class="message success"><p><?php echo $sf_user->getFlash('success_message') ?></p></div>
		<?php endif; ?>
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

		        </td>
		      </tr>
		    </tfoot>
		  </table>
		</form>
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block.small.left ends -->



<div class="block small right">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Fazer cadastro</h2>
	</div>		<!-- .block_head ends -->
	
	
	
	<div class="block_content">
	
		<h2>Ainda não sou registrado.</h2>
		<p>Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.</p>
		<form action="<?php echo url_for('cadastro/index') ?>" method="post">
		<p><input type="submit" value="Fazer Cadastro" class="submit long" /></p>
		</form>
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block.small.right ends -->



