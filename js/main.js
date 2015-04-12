 $(document).foundation();

 var laptopCata = $('.catalogue');

 laptopCata.isotope({
 	itemSelector: '.catalogueEntry',
 	layoutMode: 'fitRows',
 	getSortData: {
 		name: function( itemElem ) { // function
		    var name = $( itemElem ).find('.cataItemName').text();
		    return name;
	    },
	    os: function( itemElem ) { // function
		    var os = $( itemElem ).find('.os').text();
		    return os;
	    },
	    cpu: function( itemElem ) { // function
		    var cpu = $( itemElem ).find('.cpuspeed').text();
		    return parseFloat(cpu);
	    },
	    ramsize: function( itemElem ) { // function
		    var ramsize = $( itemElem ).find('.ramsize').text();
		    return parseInt(ramsize);
	    },
	    screenSize: function( itemElem ) { // function
		    var screenSize = $( itemElem ).find('.screenSize').text();
		    return parseFloat(screenSize);
	    },
		price: function( itemElem ) { // function
		    var price = $( itemElem ).find('.price').text();
		    //price = price.replace(/./g, '.');
		    return parseFloat(price);
	    }
	}
});

 $("#sortBy").change(function(){
 	var sortOption = $("#sortBy option:selected").val();

 	switch(sortOption){
 		case "name":
 			laptopCata.isotope({ sortBy : 'name', sortAscending: true});
 			break;

 		case "os":
 			laptopCata.isotope({ sortBy : 'os' });
 			break;

 		case "ramsize":
 			laptopCata.isotope({ sortBy : 'ramsize', sortAscending: false });
 			break;

 		case "cpuspeed":
 			laptopCata.isotope({ sortBy : 'cpu', sortAscending: false });
 			break;

 		case "screensize":
 			laptopCata.isotope({ sortBy : 'screenSize', sortAscending: false });
 			break;

 		case "price":
 			laptopCata.isotope({ sortBy : 'price', sortAscending: false });
 			break;

 		default:
 			break;
 	}
 });

/* ===== FILTER ===== */
var filterString = "?filter=1";

// CPU clockspeed slider formating
var cpu_clockspeed = 1.1; // Current ghz
var cpu_clockspeed_output = $("#cpu_ghz_output"); // Output field

$("#cpu_clockspeed").bind("change", function(){
	cpu_clockspeed = $(this).attr("data-slider"); // Get value
	// Add dot between numbers
	cpu_clockspeed = cpu_clockspeed.substr(0,1) + "." + cpu_clockspeed.substr(1,1);
	// Output
	cpu_clockspeed_output.text(cpu_clockspeed);
});

// Screen Resolution slider formating
var screen_res = 10; // Current resolution
var screen_res_output = $("#screen_res_output"); // Output field

$("#screen_res").bind("change", function(){
	screen_res = $(this).attr("data-slider"); // Get value
	// Display correct text
	switch(screen_res){
		case "10":
			screen_res_output.text("720p");
			break;

		case "20":
			screen_res_output.text("1080p");
			break;

		case "30":
			screen_res_output.text("2.5K");
			break;

		case "40":
			screen_res_output.text("3K");
			break;

		case "50":
			screen_res_output.text("4K");
			break;

		case "60":
			screen_res_output.text("4K<");
			break;

		default:
			break;
	}
	
});

// Screen Size slider formating
var screen_size = 10; // Current size
var screen_size_output = $("#screen_size_output"); // Output field

$("#screen_size").bind("change", function(){
	screen_size = $(this).attr("data-slider"); // Get value
	// Display correct text
	switch(screen_size){
		case "10":
			screen_size_output.text("10\"");
			break;

		case "20":
			screen_size_output.text("13\"");
			break;

		case "30":
			screen_size_output.text("15\"");
			break;

		case "40":
			screen_size_output.text("17\"");
			break;

		default:
			break;
	}
});


// Submit filters
$("#filterButton").click(function(){
	/* === CPU === */
	// Type
	var cputypes = $("input[name='cpu_type[]']:checked");

    if(cputypes.length != 2){
    	filterString += "&cpu_type=" + cputypes.val();
    }

	// Cores
	var cpucores = $("input[name='cpu_cores[]']:checked");

    if(cpucores.length != 2){
    	filterString += "&cpu_cores=" + cpucores.val();
    }

    // Clockspeed
    filterString += "&cpu_clockspeed=" + cpu_clockspeed;

    /* === RAM === */
	// Type
	var ramtypes = $("input[name='ram_type[]']:checked");

    if(ramtypes.length != 2){
    	filterString += "&ram_type=" + ramtypes.val();
    }

	// Clockspeed
	var ramspeed = $("input[name='ram_clockspeed[]']:checked");

    if(ramspeed.length != 2){
    	filterString += "&ram_clockspeed=" + ramspeed.val();
    }

    // Size
    filterString += "&ram_size=" + $("#ram_size").attr("data-slider");

    /* === Storage === */
	// Type
	var storagetypes = $("input[name='storage_type[]']:checked");

    if(storagetypes.length != 4){
    	storagetypes.each(function()
		{
			filterString += "&storage_type[]=" + $(this).val();
		});
    }

    // Size
    filterString += "&storage_size=" + $("#storage_size").attr("data-slider");

    /* === Screen === */
	// Type
	var screentypes = $("input[name='screen_type[]']:checked");

    if(screentypes.length != 3){
    	screentypes.each(function()
		{
			filterString += "&screen_type[]=" + $(this).val();
		});
    }

    // Size
    filterString += "&screen_size=" + screen_size;

    // Resolution
    filterString += "&screen_resolution=" + screen_res;

    // Localhost
	window.location.href = "http://localhost:1234/vef3a-lokaverkefni2/vef3a-lokaverkefni/" + filterString;

	//X.is
	//window.location.href = "http://okeyp.is/vef3a/" + filterString;
});