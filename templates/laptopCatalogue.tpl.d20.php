<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="row filterBar">
	<div class="large-2 columns">
		<button class="sortButton sortName">Sort:Name</button>
	</div>
	<div class="large-2 columns">
		<button class="sortButton sortOS">Sort:OS</button>
	</div>
	<div class="large-2 columns">
		<button class="sortButton sortRam">Sort:RamSize</button>
	</div>	
	<div class="large-2 columns">
		<button class="sortButton sortCPU">Sort:CPUspeed</button>
	</div>	
	<div class="large-2 columns">
		<button class="sortButton sortScreen">Sort:ScreenSize</button>
	</div>
	<div class="large-2 columns">
		<button class="sortButton sortPrice">Sort:Price</button>
	</div>	
</div>

<div class='row catalogue' data-equalizer>
<?php 
$_fh0_data = (isset($this->scope["laptops"]) ? $this->scope["laptops"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['key']=>$this->scope['value'])
	{
/* -- foreach start output */
?>

	<a href="<?php echo $this->scope["value"]["url"];?>" class='large-3 columns catalogueEntry panel' data-equalizer-watch>
		<h4 class='cataItemName'><?php echo $this->scope["value"]["name"];?></h4>
		<ul class='cataItemSpec'>
			<li>OS: <span class="os"><?php echo $this->scope["value"]["os"];?></span></li>
			<li>CPU: <?php echo $this->scope["value"]["cpu"]["type"];?> <?php echo $this->scope["value"]["cpu"]["family"];?> @ <span class="cpuspeed"><?php echo $this->scope["value"]["cpu"]["clockspeed"];?></span>GHz</li>
			<li>RAM: <span class="ramsize"><?php echo $this->scope["value"]["ram"]["size"];?></span>GB <?php echo $this->scope["value"]["ram"]["type"];?> @ <?php echo $this->scope["value"]["ram"]["clockspeed"];?>MHz</li>
			<li>Storage: <?php echo $this->scope["value"]["storage"]["size"];
echo $this->scope["value"]["storage"]["ssd_size"];?> GB <?php echo $this->scope["value"]["storage"]["type"];?></li>
			<li>Screen: <span class="screenSize"><?php echo $this->scope["value"]["screen"]["size"];?></span>" @ <?php echo $this->scope["value"]["screen"]["resolution"];?></li>
			<li>Price: <span class="price"><?php echo $this->scope["value"]["price"];?></span></li>
		</ul>
	</a>

<?php 
/* -- foreach end output */
	}
}?>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>