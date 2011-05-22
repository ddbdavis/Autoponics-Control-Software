<div id="header">
		<h1 class="logo" onclick="window.open('/','_self');">Autoponics Control System</h1>
		<ul>
				<?php if($is_authenticated): ?>
				<li><a href="/logout">Logout</a></li>
				<?php else: ?>
				<li><a href="/login">Login</a></li>
				<?php endif; ?>
		</ul>
		<div class="clear"></div>
</div>
<div class="container_12">