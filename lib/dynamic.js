
	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById("clock").innerHTML = moment(); //today.toUTCString();
		var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
    	if (i < 10) {i = "0" + i}; 
    	return i;
	}
	
	
      
      
      function startElapseTime(start){		
      	var st = moment.tz(start,"YYYY-MM-DD HH:mm:ss", "America/Denver");
      	var stt = moment(start,"YYYY-MM-DD HH:mm:ss");
		var duration = moment.duration(moment().diff(st));

		//var ststring = moment("2016-05-22 22:13:55-07:00");
		//var endstring = moment("2016-05-22 23:13:55-07:00");
		//var duration = moment.duration(endstring.diff(ststring));
		var out = duration.get("hours") +" hr "+ duration.get("minutes") +" min "+ duration.get("seconds") + " sec";
		//var sec = endstring.diff(ststring, 'minutes');
		//var test = moment("1", "m").format();
		//= moment(start,"YYYY-MM-DD HH:mm:ss"); //"HH:mm:ss"
		//var diff = moment(moment().diff(moment(start,"YYYY-MM-DD HH:mm:ss"))).format("HH:mm:ss");
		//var examaple = moment(moment(1390310146).diff( 1390309386)).format('H m s');
		//var now = moment().tz("America/Denver").format();
		
		document.getElementById("elapse").innerHTML = out;

		var t = setTimeout(function() {startElapseTime(start);}, 500);
      }

