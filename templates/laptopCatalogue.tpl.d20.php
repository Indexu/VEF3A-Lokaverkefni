<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Filter Area -->
<div id="filterBar" class="row indentBox">
	<div class="large-12 columns">
		<!-- Filter boxes -->
		<div class="row" data-equalizer>

			<!-- CPU -->
			<div class="large-3 columns" data-equalizer-watch>
				<div class="filterBox">
					<!-- Filter box header -->
					<div class="row filterHeader">
						<div class="large-12 columns">
							<h3>CPU</h3>
						</div>
					</div>
					<!-- Filter box content -->
					<div class="row filterContent">
						<div class="large-12 columns">
							<!-- CPU Type -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Type</p>
								</div>
								<div class="large-9 columns">
									<!-- Intel -->
									<input id="filterIntel" class="filterSetting" value="intel" name="cpu_type[]" type="checkbox" <?php if ((isset($this->scope["filters"]["cpu_type"]) ? $this->scope["filters"]["cpu_type"]:null) == "intel") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["cpu_type"]) ? $this->scope["filters"]["cpu_type"]:null)) {
?> checked <?php 
}?>><label for="filterIntel">Intel</label>
									<!-- AMD -->
									<input id="filterAMD" class="filterSetting" value="amd" name="cpu_type[]" type="checkbox" <?php if ((isset($this->scope["filters"]["cpu_type"]) ? $this->scope["filters"]["cpu_type"]:null) == "amd") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["cpu_type"]) ? $this->scope["filters"]["cpu_type"]:null)) {
?> checked <?php 
}?>><label for="filterAMD">AMD</label>
								</div>
							</div>

							<!-- CPU Cores -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Cores</p>
								</div>
								<div class="large-9 columns">
									<!-- 2 Cores -->
									<input id="cores2" class="filterSetting" value="2" name="cpu_cores[]" type="checkbox" <?php if ((isset($this->scope["filters"]["cpu_cores"]) ? $this->scope["filters"]["cpu_cores"]:null) == "2") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["cpu_cores"]) ? $this->scope["filters"]["cpu_cores"]:null)) {
?> checked <?php 
}?>><label for="cores2">2</label>
									<!-- 4 Cores -->
									<input id="cores4" class="filterSetting" value="4" name="cpu_cores[]" type="checkbox" <?php if ((isset($this->scope["filters"]["cpu_cores"]) ? $this->scope["filters"]["cpu_cores"]:null) == "4") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["cpu_cores"]) ? $this->scope["filters"]["cpu_cores"]:null)) {
?> checked <?php 
}?>><label for="cores4">4</label>
								</div>
							</div>
							
							<!-- CPU Clockspeed -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GHz</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="cpu_clockspeed" class="range-slider radius" data-slider data-options="start: 11; end: 29; <?php if ((isset($this->scope["filters"]["cpu_clockspeed"]) ? $this->scope["filters"]["cpu_clockspeed"]:null)) {
?> initial: <?php echo str_replace(".", "", (isset($this->scope["filters"]["cpu_clockspeed"]) ? $this->scope["filters"]["cpu_clockspeed"]:null));?>; <?php 
}
else if (! (isset($this->scope["filters"]["cpu_clockspeed"]) ? $this->scope["filters"]["cpu_clockspeed"]:null)) {
?> initial: 11; <?php 
}?>">
								      	<span id="cpu_ghz_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								      	<span class="range-slider-active-segment"></span>
							    	</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>

			<!-- RAM -->
			<div class="large-3 columns" data-equalizer-watch>
				<div class="filterBox">
					<!-- Filter box header -->
					<div class="row filterHeader">
						<div class="large-12 columns">
							<h3>RAM</h3>
						</div>
					</div>
					<!-- Filter box content -->
					<div class="row filterContent">
						<div class="large-12 columns">
							<!-- RAM Type -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Type</p>
								</div>
								<div class="large-9 columns">
									<!-- DDR3 -->
									<input id="ddr3" class="filterSetting" value="ddr3" name="ram_type[]" type="checkbox" <?php if ((isset($this->scope["filters"]["ram_type"]) ? $this->scope["filters"]["ram_type"]:null) == "ddr3") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["ram_type"]) ? $this->scope["filters"]["ram_type"]:null)) {
?> checked <?php 
}?>><label for="ddr3">DDR3</label>
									<!-- DDR3L -->
									<input id="ddr3l" class="filterSetting" value="ddr3l" name="ram_type[]" type="checkbox" <?php if ((isset($this->scope["filters"]["ram_type"]) ? $this->scope["filters"]["ram_type"]:null) == "ddr3l") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["ram_type"]) ? $this->scope["filters"]["ram_type"]:null)) {
?> checked <?php 
}?>><label for="ddr3l">DDR3L</label>
								</div>
							</div>

							<!-- RAM Clockspeed -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GHz</p>
								</div>
								<div class="large-9 columns">
									<!-- 1333 -->
									<input id="ram1333" class="filterSetting" value="1333" name="ram_clockspeed[]" type="checkbox" <?php if ((isset($this->scope["filters"]["ram_clockspeed"]) ? $this->scope["filters"]["ram_clockspeed"]:null) == "1333") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["ram_clockspeed"]) ? $this->scope["filters"]["ram_clockspeed"]:null)) {
?> checked <?php 
}?>><label for="ram1333">1333</label>
									<!-- 1600 -->
									<input id="ram1600" class="filterSetting" value="1600" name="ram_clockspeed[]" type="checkbox" <?php if ((isset($this->scope["filters"]["ram_clockspeed"]) ? $this->scope["filters"]["ram_clockspeed"]:null) == "1600") {
?> checked <?php 
}
else if (! (isset($this->scope["filters"]["ram_clockspeed"]) ? $this->scope["filters"]["ram_clockspeed"]:null)) {
?> checked <?php 
}?>><label for="ram1600">1600</label>
								</div>
							</div>
							
							<!-- RAM Size -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GB</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="ram_size" class="range-slider radius" data-slider data-options="start: 2; end: 16; <?php if ((isset($this->scope["filters"]["ram_size"]) ? $this->scope["filters"]["ram_size"]:null)) {
?> initial: <?php echo str_replace(".", "", (isset($this->scope["filters"]["ram_size"]) ? $this->scope["filters"]["ram_size"]:null));?>; <?php 
}
else if (! (isset($this->scope["filters"]["ram_size"]) ? $this->scope["filters"]["ram_size"]:null)) {
?> initial: 2; <?php 
}?> display_selector: #ram_gb_output;">
								      	<span id="ram_gb_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								      	<span class="range-slider-active-segment"></span>
							    	</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>

			<!-- Storage -->
			<div class="large-3 columns" data-equalizer-watch>
				<div class="filterBox">
					<!-- Filter box header -->
					<div class="row filterHeader">
						<div class="large-12 columns">
							<h3>Storage</h3>
						</div>
					</div>
					<!-- Filter box content -->
					<div class="row filterContent">
						<div class="large-12 columns">
							<!-- Storage Type -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Type</p>
								</div>
								<div class="large-9 columns">
									<!-- Check which storage types are being filtered -->
									<?php $this->scope["sata"]=0?>
									<?php $this->scope["sshd"]=0?>
									<?php $this->scope["ssd"]=0?>
									<?php $this->scope["flash"]=0?>
									<?php 
$_fh0_data = (isset($this->scope["filters"]["storage_type"]) ? $this->scope["filters"]["storage_type"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
										<?php if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "sata") {
?>
											<?php $this->scope["sata"]=1?>

										<?php 
}
else if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "sshd") {
?>
											<?php $this->scope["sshd"]=1?>

										<?php 
}
else if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "ssd") {
?>
											<?php $this->scope["ssd"]=1?>

										<?php 
}
else if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "flash") {
?>
											<?php $this->scope["flash"]=1?>

										<?php 
}?>
									<?php 
/* -- foreach end output */
	}
}?>

									<!-- If none are being filtered -->
									<?php if ((isset($this->scope["sata"]) ? $this->scope["sata"] : null) == 0 && (isset($this->scope["sshd"]) ? $this->scope["sshd"] : null) == 0 && (isset($this->scope["ssd"]) ? $this->scope["ssd"] : null) == 0 && (isset($this->scope["flash"]) ? $this->scope["flash"] : null) == 0) {
?>
										<?php $this->scope["sata"]=1?>
										<?php $this->scope["sshd"]=1?>
										<?php $this->scope["ssd"]=1?>
										<?php $this->scope["flash"]=1?>
									<?php 
}?>

									<!-- Output -->
									<input id="sata" class="filterSetting" value="sata" name="storage_type[]" type="checkbox" <?php if ((isset($this->scope["sata"]) ? $this->scope["sata"] : null) == 1) {
?> checked <?php 
}?>><label for="sata">SATA</label>

									<input id="sshd" class="filterSetting" value="sshd" name="storage_type[]" type="checkbox" <?php if ((isset($this->scope["sshd"]) ? $this->scope["sshd"] : null) == 1) {
?> checked <?php 
}?>><label for="sshd">SSHD</label>
									
									<input id="ssd" class="filterSetting" value="ssd" name="storage_type[]" type="checkbox" <?php if ((isset($this->scope["ssd"]) ? $this->scope["ssd"] : null) == 1) {
?> checked <?php 
}?>><label for="ssd">SSD</label>
									
									<input id="flash" class="filterSetting" value="flash" name="storage_type[]" type="checkbox" <?php if ((isset($this->scope["flash"]) ? $this->scope["flash"] : null) == 1) {
?> checked <?php 
}?>><label for="flash">Flash</label>

								</div>
							</div>
							
							<!-- Storage Size -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GB</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="storage_size" class="range-slider radius" data-slider data-options="start: 128; end: 1000; <?php if ((isset($this->scope["filters"]["storage_size"]) ? $this->scope["filters"]["storage_size"]:null)) {
?> initial: <?php echo str_replace(".", "", (isset($this->scope["filters"]["storage_size"]) ? $this->scope["filters"]["storage_size"]:null));?>; <?php 
}
else if (! (isset($this->scope["filters"]["storage_size"]) ? $this->scope["filters"]["storage_size"]:null)) {
?> initial: 128; <?php 
}?> display_selector: #storage_gb_output;">
								      	<span id="storage_gb_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								      	<span class="range-slider-active-segment"></span>
							    	</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>

			<!-- Screen -->
			<div class="large-3 columns" data-equalizer-watch>
				<div class="filterBox">
					<!-- Filter box header -->
					<div class="row filterHeader">
						<div class="large-12 columns">
							<h3>Screen</h3>
						</div>
					</div>
					<!-- Filter box content -->
					<div class="row filterContent">
						<div class="large-12 columns">
							<!-- Screen Type -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Type</p>
								</div>
								<div class="large-9 columns">
									<!-- Check which screen types are being filtered -->
									<?php $this->scope["led"]=0?>
									<?php $this->scope["ips"]=0?>
									<?php $this->scope["retina"]=0?>
									<?php 
$_fh1_data = (isset($this->scope["filters"]["screen_type"]) ? $this->scope["filters"]["screen_type"]:null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
										<?php if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "led") {
?>
											<?php $this->scope["led"]=1?>

										<?php 
}
else if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "ips") {
?>
											<?php $this->scope["ips"]=1?>

										<?php 
}
else if ((isset($this->scope["val"]) ? $this->scope["val"] : null) == "retina") {
?>
											<?php $this->scope["retina"]=1?>

										<?php 
}?>
									<?php 
/* -- foreach end output */
	}
}?>

									<!-- If none are being filtered -->
									<?php if ((isset($this->scope["led"]) ? $this->scope["led"] : null) == 0 && (isset($this->scope["ips"]) ? $this->scope["ips"] : null) == 0 && (isset($this->scope["retina"]) ? $this->scope["retina"] : null) == 0) {
?>
										<?php $this->scope["led"]=1?>
										<?php $this->scope["ips"]=1?>
										<?php $this->scope["retina"]=1?>
									<?php 
}?>

									<!-- Output -->
									<input id="led" class="filterSetting" value="led" name="screen_type[]" type="checkbox" <?php if ((isset($this->scope["led"]) ? $this->scope["led"] : null) == 1) {
?> checked <?php 
}?>><label for="led">LED</label>

									<input id="ips" class="filterSetting" value="ips" name="screen_type[]" type="checkbox" <?php if ((isset($this->scope["ips"]) ? $this->scope["ips"] : null) == 1) {
?> checked <?php 
}?>><label for="ips">IPS</label>
									
									<input id="retina" class="filterSetting" value="retina" name="screen_type[]" type="checkbox" <?php if ((isset($this->scope["retina"]) ? $this->scope["retina"] : null) == 1) {
?> checked <?php 
}?>><label for="retina">Retina</label>

								</div>
							</div>

							<!-- Screen Size -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Size</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="screen_size" class="range-slider radius" data-slider data-options="start: 10; end: 40; <?php if ((isset($this->scope["filters"]["screen_size"]) ? $this->scope["filters"]["screen_size"]:null)) {
?> initial: <?php echo $this->scope["filters"]["screen_size"];?>; <?php 
}
else if (! (isset($this->scope["filters"]["screen_size"]) ? $this->scope["filters"]["screen_size"]:null)) {
?> initial: 10; <?php 
}?> step: 10;">
								      	<span id="screen_size_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								      	<span class="range-slider-active-segment"></span>
							    	</div>
								</div>
							</div>
							
							<!-- Screen Resolution -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Res.</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="screen_res" class="range-slider radius" data-slider data-options="start: 10; end: 60; <?php if ((isset($this->scope["filters"]["screen_resolution"]) ? $this->scope["filters"]["screen_resolution"]:null)) {
?> initial: <?php echo $this->scope["filters"]["screen_resolution"];?>; <?php 
}
else if (! (isset($this->scope["filters"]["screen_resolution"]) ? $this->scope["filters"]["screen_resolution"]:null)) {
?> initial: 10; <?php 
}?> step: 10;">
								      	<span id="screen_res_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								      	<span class="range-slider-active-segment"></span>
							    	</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>

		</div>

		<!-- Price slider row -->
		<div class="row">

			<div class="large-12 columns">

				<div class="filterBox priceBox">
					<div class="row filterHeader">
						<div class="large-12 columns">
							<h3>Price</h3>
						</div>
					</div>

					<div class="row">

						<div class="large-6 columns">
							<p class="priceSubtitle">Min.</p>
							<div id="min_price" class="range-slider radius" data-slider data-options="start: 0; end: 500000; <?php if ((isset($this->scope["filters"]["minPrice"]) ? $this->scope["filters"]["minPrice"]:null)) {
?> initial: <?php echo $this->scope["filters"]["minPrice"];?>; <?php 
}
else if (! (isset($this->scope["filters"]["minPrice"]) ? $this->scope["filters"]["minPrice"]:null)) {
?> initial: 0; <?php 
}?> step: 1000; display_selector: #min_price_output;">
								<span id="min_price_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								<span class="range-slider-active-segment"></span>
							</div>
						</div>

						<div class="large-6 columns">
							<p class="priceSubtitle">Max.</p>
							<div id="max_price" class="range-slider radius" data-slider data-options="start: 0; end: 500000; <?php if ((isset($this->scope["filters"]["maxPrice"]) ? $this->scope["filters"]["maxPrice"]:null)) {
?> initial: <?php echo $this->scope["filters"]["maxPrice"];?>; <?php 
}
else if (! (isset($this->scope["filters"]["maxPrice"]) ? $this->scope["filters"]["maxPrice"]:null)) {
?> initial: 500000; <?php 
}?> step: 1000; display_selector: #max_price_output;">
								<span id="max_price_output" class="range-slider-handle" role="slider" tabindex="0"></span>
								<span class="range-slider-active-segment"></span>
							</div>
						</div>
					
					</div>

					

				</div>
				
			</div>
			
		</div>

		<!-- Filter Button row -->
		<div class="row">
			<div class="large-12 columns">
				<button id="filterButton">Go</button>
			</div>
		</div>
				
	</div>
	

	
	
</div>

<div class="row">
	<div class="large-4 columns">
		<select id="sortBy">
			<option selected disabled>Sort By</option>
			<option value="name">Name</option>
			<option value="os">OS</option>4
			<option value="ramsize">Ram Size</option>
			<option value="cpuspeed">CPU Speed</option>
			<option value="screensize">Screen Size</option>
			<option value="price">Price</option>
		</select>
	</div>
</div>

<div class='row catalogue'>

<?php $this->scope["counter"]=0?>
<?php 
$_fh2_data = (isset($this->scope["laptops"]) ? $this->scope["laptops"] : null);
if ($this->isTraversable($_fh2_data) == true)
{
	foreach ($_fh2_data as $this->scope['key']=>$this->scope['value'])
	{
/* -- foreach start output */
?>

	<?php if ((isset($this->scope["counter"]) ? $this->scope["counter"] : null)%4 == 0) {
?>
		<?php if ((isset($this->scope["counter"]) ? $this->scope["counter"] : null) != 0) {
?>
			</div>
		<?php 
}?>
		<div class='row catalogueRow' data-equalizer>
	<?php 
}?>

	<a href="<?php echo $this->scope["value"]["url"];?>" class='large-3 columns catalogueEntry' data-equalizer-watch>
		<div class="cataItem">
			<h4 class='cataItemName'><?php echo $this->scope["value"]["name"];?></h4>
			<ul class='cataItemSpec'>
				<li><span class="cataItemSpecTitle">OS</span> <span class="os"><?php echo $this->scope["value"]["os"];?></span></li>
				<li><span class="cataItemSpecTitle">CPU</span> <?php echo $this->scope["value"]["cpu"]["type"];?> <?php echo $this->scope["value"]["cpu"]["family"];?> @ <span class="cpuspeed"><?php echo $this->scope["value"]["cpu"]["clockspeed"];?></span>GHz</li>
				<li><span class="cataItemSpecTitle">RAM</span> <span class="ramsize"><?php echo $this->scope["value"]["ram"]["size"];?></span>GB <?php echo $this->scope["value"]["ram"]["type"];?> @ <?php echo $this->scope["value"]["ram"]["clockspeed"];?>MHz</li>
				<li><span class="cataItemSpecTitle">Storage</span> <?php echo $this->scope["value"]["storage"]["size"];
echo $this->scope["value"]["storage"]["ssd_size"];?> GB <?php echo $this->scope["value"]["storage"]["type"];?></li>
				<li><span class="cataItemSpecTitle">Screen</span> <span class="screenSize"><?php echo $this->scope["value"]["screen"]["size"];?></span>" @ <?php echo $this->scope["value"]["screen"]["resolution"];?></li>
					
			</ul>

			<div class="price">
				<p><?php echo $this->scope["value"]["price"];?> kr.</p>
			</div>

			<img src="img/elko.png">
		</div>
		
	</a>
	

  	

  	

  	

  	<!--<a href="<?php echo $this->scope["value"]["url"];?>" class='large-3 columns catalogueEntry' data-equalizer-watch>
		<div class="testing">
			<h4 class='cataItemName'><?php echo $this->scope["value"]["name"];?></h4>
			<ul class='cataItemSpec'>
				<li>OS: <span class="os"><?php echo $this->scope["value"]["os"];?></span></li>
				<li>CPU: <?php echo $this->scope["value"]["cpu"]["type"];?> <?php echo $this->scope["value"]["cpu"]["family"];?> @ <span class="cpuspeed"><?php echo $this->scope["value"]["cpu"]["clockspeed"];?></span>GHz</li>
				<li>RAM: <span class="ramsize"><?php echo $this->scope["value"]["ram"]["size"];?></span>GB <?php echo $this->scope["value"]["ram"]["type"];?> @ <?php echo $this->scope["value"]["ram"]["clockspeed"];?>MHz</li>
				<li>Storage: <?php echo $this->scope["value"]["storage"]["size"];
echo $this->scope["value"]["storage"]["ssd_size"];?> GB <?php echo $this->scope["value"]["storage"]["type"];?></li>
				<li>Screen: <span class="screenSize"><?php echo $this->scope["value"]["screen"]["size"];?></span>" @ <?php echo $this->scope["value"]["screen"]["resolution"];?></li>
				
			</ul>
			<div class="price">
				<p><?php echo $this->scope["value"]["price"];?></p>
			</div>
		</div>
		
	</a> -->

	
	
	<?php $this->scope["counter"]=(isset($this->scope["counter"]) ? $this->scope["counter"] : null)+1?>
<?php 
/* -- foreach end output */
	}
}?>
</div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>