<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1>
        <a href="http://localhost/vef3a-lokaverkefni/"><?php echo $this->scope["title"];?></a>
      </h1>
    </li>
  </ul>
</nav><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>