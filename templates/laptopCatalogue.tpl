<div class="row filterBar">
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
{foreach $laptops, key, value, name='default'}

	<a href="{$value.url}" class='large-3 columns catalogueEntry panel' data-equalizer-watch>
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