<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="row">	
	<div class="large-12 columns">
		<h2>Contact</h2>
		<p>Hægt er að ná í mig í gegnum <a href="https://github.com/Indexu/">GitHub</a> eða e-mail: hilmart@gmail.com</p>
	</div>
</div>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>