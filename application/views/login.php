<div class="grid_3">&nbsp;</div>
<div class="grid_6">
		<div class="login">
				<div class="errors">
				<?php echo validation_errors(); ?>
				</div>
				<p>Login to the Autoponics Control System.</p>
				<form action="/login" method="POST">
						<label>Email</label>
						<input name="email" type="text" size="40" value="<?php echo set_value('email',''); ?>" />
						<label>Password</label>
						<input name="password" type="password" size="40"/>
						<label>&nbsp;</label>
						<input type="submit" value="Log in" />
						<div class="clear"></div>
				</form>
		</div>
</div>
<div class="grid_3">&nbsp;</div>
<div class="clear"></div>

