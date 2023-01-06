
	function data_request_timer(){
		window.setInterval(get_data, 2000); //timer for running get_data() function every 2 seconds 
	}

	function get_data(){
		console.log("fetching data from server");
//ajax calls to fetch data
		$.get("read_data1.php", 
		function(data, status){
	    	document.getElementById("info").innerHTML = data;
	  	});

	}


