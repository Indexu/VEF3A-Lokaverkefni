<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="footer">
	<div class="row">	
		<div class="large-4 columns">
			<a href="http://localhost/vef3a-lokaverkefni/about">About</a>
		</div>
		<div class="large-4 columns">
			<a href="http://localhost/vef3a-lokaverkefni/contact">Contact</a>
		</div>
		<div class="large-4 columns">
			<a href="https://github.com/Indexu/VEF3A-Lokaverkefni">GitHub</a>
		</div>
	</div>
</div>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>