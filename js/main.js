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
		    return parseInt(price);
	    }
	}
});

$(".sortName").click(function(){
	laptopCata.isotope({ sortBy : 'name', sortAscending: true});
	$(document).foundation('equalizer', 'equalize');
});

$(".sortOS").click(function(){
	laptopCata.isotope({ sortBy : 'os' });
	$(document).foundation('equalizer', 'equalize');
});

$(".sortRam").click(function(){
	laptopCata.isotope({ sortBy : 'ramsize', sortAscending: false });
	$(document).foundation('equalizer', 'equalize');
});

$(".sortCPU").click(function(){
	laptopCata.isotope({ sortBy : 'cpu', sortAscending: false });
	$(document).foundation('equalizer', 'equalize');
});

$(".sortScreen").click(function(){
	laptopCata.isotope({ sortBy : 'screenSize', sortAscending: false });
	$(document).foundation('equalizer', 'equalize');
});

$(".sortPrice").click(function(){
	laptopCata.isotope({ sortBy : 'price', sortAscending: false });
	$(document).foundation('equalizer', 'equalize');
});

