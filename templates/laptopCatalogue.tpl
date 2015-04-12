<!-- Filter Area -->
<div id="filterBar" class="row indentBox">
	<div class="large-12 columns">
		<!-- Filter boxes -->
		<div class="row">

			<!-- CPU -->
			<div class="large-3 columns">
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
									<input id="filterIntel" class="filterSetting" value="intel" name="cpu_type[]" type="checkbox" {if $filters.cpu_type == "intel"} checked {elseif !$filters.cpu_type} checked {/if}><label for="filterIntel">Intel</label>
									<!-- AMD -->
									<input id="filterAMD" class="filterSetting" value="amd" name="cpu_type[]" type="checkbox" {if $filters.cpu_type == "amd"} checked {elseif !$filters.cpu_type} checked {/if}><label for="filterAMD">AMD</label>
								</div>
							</div>

							<!-- CPU Cores -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Cores</p>
								</div>
								<div class="large-9 columns">
									<!-- 2 Cores -->
									<input id="cores2" class="filterSetting" value="2" name="cpu_cores[]" type="checkbox" {if $filters.cpu_cores == "2"} checked {elseif !$filters.cpu_cores} checked {/if}><label for="cores2">2</label>
									<!-- 4 Cores -->
									<input id="cores4" class="filterSetting" value="4" name="cpu_cores[]" type="checkbox" {if $filters.cpu_cores == "4"} checked {elseif !$filters.cpu_cores} checked {/if}><label for="cores4">4</label>
								</div>
							</div>
							
							<!-- CPU Clockspeed -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GHz</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="cpu_clockspeed" class="range-slider radius" data-slider data-options="start: 11; end: 29; {if $filters.cpu_clockspeed} initial: {replace $filters.cpu_clockspeed "." ""}; {elseif !$filters.cpu_clockspeed} initial: 11; {/if}">
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
			<div class="large-3 columns">
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
									<input id="ddr3" class="filterSetting" value="ddr3" name="ram_type[]" type="checkbox" {if $filters.ram_type == "ddr3"} checked {elseif !$filters.ram_type} checked {/if}><label for="ddr3">DDR3</label>
									<!-- DDR3L -->
									<input id="ddr3l" class="filterSetting" value="ddr3l" name="ram_type[]" type="checkbox" {if $filters.ram_type == "ddr3l"} checked {elseif !$filters.ram_type} checked {/if}><label for="ddr3l">DDR3L</label>
								</div>
							</div>

							<!-- RAM Clockspeed -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GHz</p>
								</div>
								<div class="large-9 columns">
									<!-- 1333 -->
									<input id="ram1333" class="filterSetting" value="1333" name="ram_clockspeed[]" type="checkbox" {if $filters.ram_clockspeed == "1333"} checked {elseif !$filters.ram_clockspeed} checked {/if}><label for="ram1333">1333</label>
									<!-- 1600 -->
									<input id="ram1600" class="filterSetting" value="1600" name="ram_clockspeed[]" type="checkbox" {if $filters.ram_clockspeed == "1600"} checked {elseif !$filters.ram_clockspeed} checked {/if}><label for="ram1600">1600</label>
								</div>
							</div>
							
							<!-- RAM Size -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GB</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="ram_size" class="range-slider radius" data-slider data-options="start: 2; end: 16; {if $filters.ram_size} initial: {replace $filters.ram_size "." ""}; {elseif !$filters.ram_size} initial: 2; {/if} display_selector: #ram_gb_output;">
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
			<div class="large-3 columns">
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
									{$sata = 0}
									{$sshd = 0}
									{$ssd = 0}
									{$flash = 0}
									{foreach $filters.storage_type val}
										{if $val == "sata"}
											{$sata = 1}

										{elseif $val == "sshd"}
											{$sshd = 1}

										{elseif $val == "ssd"}
											{$ssd = 1}

										{elseif $val == "flash"}
											{$flash = 1}

										{/if}
									{/foreach}

									<!-- If none are being filtered -->
									{if $sata == 0 and $sshd == 0 and $ssd == 0 and $flash == 0}
										{$sata = 1}
										{$sshd = 1}
										{$ssd = 1}
										{$flash = 1}
									{/if}

									<!-- Output -->
									<input id="sata" class="filterSetting" value="sata" name="storage_type[]" type="checkbox" {if $sata == 1} checked {/if}><label for="sata">SATA</label>

									<input id="sshd" class="filterSetting" value="sshd" name="storage_type[]" type="checkbox" {if $sshd == 1} checked {/if}><label for="sshd">SSHD</label>
									
									<input id="ssd" class="filterSetting" value="ssd" name="storage_type[]" type="checkbox" {if $ssd == 1} checked {/if}><label for="ssd">SSD</label>
									
									<input id="flash" class="filterSetting" value="flash" name="storage_type[]" type="checkbox" {if $flash == 1} checked {/if}><label for="flash">Flash</label>

								</div>
							</div>
							
							<!-- Storage Size -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>GB</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="storage_size" class="range-slider radius" data-slider data-options="start: 128; end: 1000; {if $filters.storage_size} initial: {replace $filters.storage_size "." ""}; {elseif !$filters.storage_size} initial: 128; {/if} display_selector: #storage_gb_output;">
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
			<div class="large-3 columns">
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
									{$led = 0}
									{$ips = 0}
									{$retina = 0}
									{foreach $filters.screen_type val}
										{if $val == "led"}
											{$led = 1}

										{elseif $val == "ips"}
											{$ips = 1}

										{elseif $val == "retina"}
											{$retina = 1}

										{/if}
									{/foreach}

									<!-- If none are being filtered -->
									{if $led == 0 and $ips == 0 and $retina == 0}
										{$led = 1}
										{$ips = 1}
										{$retina = 1}
									{/if}

									<!-- Output -->
									<input id="led" class="filterSetting" value="led" name="screen_type[]" type="checkbox" {if $led == 1} checked {/if}><label for="led">LED</label>

									<input id="ips" class="filterSetting" value="ips" name="screen_type[]" type="checkbox" {if $ips == 1} checked {/if}><label for="ips">IPS</label>
									
									<input id="retina" class="filterSetting" value="retina" name="screen_type[]" type="checkbox" {if $retina == 1} checked {/if}><label for="retina">Retina</label>

								</div>
							</div>

							<!-- Screen Size -->
							<div class="row filterOptionRow">
								<div class="large-3 columns filterSubheader">
									<p>Size</p>
								</div>
								<!-- Slider -->
								<div class="large-9 columns">
									<div id="screen_size" class="range-slider radius" data-slider data-options="start: 10; end: 40; {if $filters.screen_size} initial: {$filters.screen_size}; {elseif !$filters.screen_size} initial: 10; {/if} step: 10;">
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
									<div id="screen_res" class="range-slider radius" data-slider data-options="start: 10; end: 60; {if $filters.screen_resolution} initial: {$filters.screen_resolution}; {elseif !$filters.screen_resolution} initial: 10; {/if} step: 10;">
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
{foreach $laptops, key, value, name='default'}

	<a href="{$value.url}" class='large-3 columns catalogueEntry panel'>
		<h4 class='cataItemName'>{$value.name}</h4>
		<ul class='cataItemSpec'>
			<li>OS: <span class="os">{$value.os}</span></li>
			<li>CPU: {$value.cpu.type} {$value.cpu.family} @ <span class="cpuspeed">{$value.cpu.clockspeed}</span>GHz</li>
			<li>RAM: <span class="ramsize">{$value.ram.size}</span>GB {$value.ram.type} @ {$value.ram.clockspeed}MHz</li>
			<li>Storage: {$value.storage.size}{$value.storage.ssd_size} GB {$value.storage.type}</li>
			<li>Screen: <span class="screenSize">{$value.screen.size}</span>" @ {$value.screen.resolution}</li>
			<li>Price: <span class="price">{$value.price}</span></li>
		</ul>
	</a>

{/foreach}
</div>