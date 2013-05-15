<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Library Observatory</title>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700' rel='stylesheet' type='text/css'>
    <link href='css/bootstrap.css' rel='stylesheet' type='text/css'>
    <link href='css/custom.css' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/fittext.js"></script>

    <script type="text/javascript" src="d3.js"></script>

    <style type="text/css">
    

body {
	margin: 0 0 0 25px;
	font-size: 12px;
	padding: 2em;
}
       
.hoverdiv {
	position:absolute;
	left:5px;
	bottom: -20px;
	clear:both;
}
        
#four .hoverdiv {
	position: relative;
	clear: both;
	margin-top:5px;

}


.itemli {
  width: 8%;
  margin: 5px 5px 0 0;
  float: left;
  list-style: none;
  position: relative;
  background: white;
  background-position: center center;
  background-size: contain;
  background-repeat: no-repeat;
  background-origin: content-box;
  border: 1px solid #EEEEEE;
  cursor: pointer;
}

.itemli.sub {
	background-color: white;
}


.hidden {
	opacity: 0;
	display: none;
}

.leftcol {
	float: left;
	position: relative;
	clear:left;
	width: 12%;
}

.leftcol img {
	width:30%;
	padding-right: 15px;
	border:none;
}

#leftlogos {
	position: relative;
	float: left;
	width: 10%;
	display: block;
}

#header {
	position: relative;
	float: left;
	display:block;
	margin-bottom:1%;
}

#header p {
	padding-top:10px;
}

#content {
	position:relative;
	float:left;
	display: block;
	width: 85%;
}

.next {
	font-size:90px;
	position: absolute;
	top:16px;
	left: 8px;
}

.nav {
	position: relative;
	clear: both;
	font-size: 24px;
	font-weight:400;
	opacity: .5;
	color:black;
}

.nav.active {
	opacity: 1;
	cursor: pointer;

}

.nav.title {
	width:80%;
	border-bottom: 5px solid black;
	margin-bottom:5px;
	opacity:1;
}

#alttree {
	position: relative;
	float: left;
	margin-top:-20px;
}

.kid {
	position: absolute;
	color:white;
	border: 3px solid white;
	overflow: hidden;
}

.divtext {
	position: absolute;
	top: 2%;
	left: 2%;
}

.divtext b {
	opacity: .7;
}

.label {
	background-color: black;
	cursor: pointer;
}

.sub {
	background-color: "#FF1E00";
	cursor: pointer;
}



.loading {
	color:"#FF1E00";
	font-size: 50px;
	margin-top: 5%;
	margin-left: 10px;
}



#back {
	cursor: pointer;
	opacity: 1;
	clear: both;
}

#back:hover {
	opacity: .5;
}

#treelabel {
	font-weight: 400;
	font-size: 36px;
	color: blue;
}

.buffer {
	margin: 30px 0 0 30px;
}

.col1 {
	position: relative;
	float:right;
	width: 50%;
	height: 100%;
}

.col2 {
	height: 100%;
	width: 45%;
	position: relative;
	float: left;
	padding-left: 20px;
}

#footer {
	position:relative;
	float: right;
}



.count {
	position: absolute;
	left: 10px;
}

.counttext {
	margin-left: 10px;
}

.path {
	opacity: 0;
}


#five {
	margin-top: 18px;
}



      
    </style>
</head>
<body>




   <div class="row-fluid">
   	<div class="leftcol"><a href="http://dp.la/" class="logo"><img src="img/dpla.png"><a/><a href="http://metalab.harvard.edu/"  class="logo"><img src="img/logo.gif"></a></div>
  	<div id="header"> 
  		<div><h1>Library Observatory</h1> </div>
  		<p>Library Observatory enables users to scan the diverse collections of the DPLA and discover items of particular interest. To get started, click in the nested graph below.
  		</p>
	</div>   
	</div>   
   
   
    
    <div id="leftnav" class="leftcol">
		<div id="prov" class="nav active current">provider</div>
		<div id="provider-path" class="path">prov</div>
		<div id="collection" class="nav">collection</div> 
		<div id="collection-path" class="path">coll</div>   
		<div id="format" class="nav">format</div>
		<div id="format-path" class="path">prov</div>
		<div id="objects" class="nav">objects</div> 
		<div id="object-path" class="path">prov</div>
		<div id="record" class="nav">record</div>
		<hr>
    
   	 <div>Toolkit:
   	 	<ul>
   	 	<li>Query builder</li>
   	 	<li><a href="./treegraph">Tree Graph</a></li>
   	 	</ul>
   	 	<a href="./about">About the project</a>
   	 </div>

  		<hr>
  		<div>
  		Find something interesting while exploring a collection? Take a screenshot and share it on our <a href="http://libobserve.tumblr.com/">tumblr</a>
  		</div>
  
  
    
    </div>
    
    <div id="content">

   	 <div id="alttree"><div id="one" data-field = "content providers"></div><div id="two" data-field = "collections"></div><div id="three" data-field = "formats"></div><div id="four" data-field = "objects"></div><div id="five"></div> 	 
   	 </div>



    </div>

   
</body>



<script type="text/javascript">
var currDiv = $("#one");

var currPage = 1;

$(".nav").mouseenter(function() {
	if($(this).hasClass("active")) $(this).css("color", "#FF1E00");
});

$(".nav").mouseleave(function() {
	if($(this).hasClass("active")) $(this).css("color", "#000000");
});


$(".nav").click(function() {
	var searchNum;
	var id = $(this).attr("id");
	if($(this).hasClass("active")) {
		if(id=="prov") {
			currDiv = $("#one");
			$("#two").html("");
			$("#three").html("");
			$("#four").html("");
			$("#five").html("");
			zoomLevel = 0;
			searchString = [];
		
					
		} else if(id== "collection") {
			currDiv = $("#two");
			$("#three").html("");
			$("#four").html("");
			$("#five").html("");
			zoomLevel = 1;


		} else if(id=="format") {
			currDiv = $("#three");
			$("#four").html("");
			$("#five").html("");
			zoomLevel = 2;

				
		} else if(id == "objects") {
			currDiv = $("#four");
			$("#five").html("");
			zoomLevel = 3;	
			
		} 
		
		$(this).nextAll(".nav").removeClass("active");
		$(this).nextAll(".path").html("blank").css("opacity", 0);

		$(".nav").removeClass("current");
		$(this).addClass("current");
		
		if(zoomLevel == 3) {
			$(currDiv).find("."+currPage).removeClass("hidden");
			$(".itemnav").removeClass("hidden");
			$(".hoverdiv").removeClass("hidden");
			if(currPage == 1) $("#loadless").addClass("hidden");
		}
		else $(currDiv).find("div").removeClass("hidden");
		$(currDiv).find("div").removeClass("active");
		
		for(i = 0; i < (searchString.length - zoomLevel); i++) {
			searchString.pop();
		}
		
	}

});
	
	var colors = new Array("#969696", "#B5B5B5", "#8F8F8F");

    var chartWidth = window.innerWidth * 0.8;
    var chartHeight = window.innerHeight * 0.7;
	
    
    var xscale = d3.scale.linear().range([0, chartWidth]);
    var yscale = d3.scale.linear().range([0, chartHeight]);
    var color = d3.scale.category20();
    var headerHeight = 20;
    var headerColor = "#555555";
    var transitionDuration = 500;
    var root;
    var node;
    //var fetchedData;
    var zoomLevel = 0;

    var treemap = d3.layout.treemap()
            .size([chartWidth, chartHeight])
            .padding([headerHeight + 1, 1, 1, 1])
            .value(function(d) {
                return d.size;
            })
            ;
            



 

	getPermutations([null, null, null], "provider.name");
    //d3.json("prov_coll.json", function(data) { shelfData = data; fetchedData = data; replaceTreemap(); });

    //d3.selectAll("select").on("change", replaceTreemap);

	function loadNewQuery(searchBase, tried1) {
   		$(".sub").addClass("hidden");
		currDiv = $("#four");
		$("li.sub").addClass("hidden");
		
		
		var loadtext = "loading...";
		//if(tried1) loadtext = "(re)loading...";
		$(currDiv).append("<div class='loading'>"+loadtext+"</div>");
		
		var moreAdded = false;
		$.ajax({url: "pull_data.php", type: 'post', data: {search1: searchBase[0], search2: searchBase[1], search3: searchBase[2], qFormat: tried1, page: currPage, level: zoomLevel}}).done( function(items_raw) {
	
			var data = neatenJSON(items_raw);
			var totalpages = Math.ceil(data.count / data.limit);
			$("#wholecount").html(totalpages);
			$("#partcount").html(currPage);
			if(currPage == Math.ceil(data.count / data.limit)) $("#loadmore").css("opacity", .7);
			
			if(data.docs.length == 0) {
				if(!tried1) {
					$(".loading").remove();
					
					loadNewQuery(searchBase, true)
				
				} else {
					$("#four").append("<h3>zero results</h4>");
					$(".loading").remove();

				}
			}
			
			//TODO add error message if it's a bad request if();
			
			$("#loadless").addClass("hidden");

			$.each(data.docs, function(i, val) {
				$(".loading").addClass("hidden");
				$("#loadmore").removeClass("hidden");
				$("#pagecount").removeClass("hidden");
				$(currDiv).find(".hoverdiv").removeClass("hidden");
				
				var li = $('<li class="itemli sub thumb '+currPage+'" data-id="' + val.id + ' data-gall="'+currPage+'"/>');
    			var imgurl =val.object;
    			var link= val.isShownAt;
    			if(imgurl == undefined) imgurl = "missing.gif";
				$(li).css('background-image','url('+ imgurl +')');
				$(li).css('width',"60px");
    			$(li).css('height',"60px");	
    			
    			$(li).append("<div class='info hidden'><span class='title'></span><span class='description'></span><span class='format'></span><span class='collection'></span><span class='link'></span><span class='date'></span><span class='rights'></span><span class='creator'></span>");
    			
    			if(val.sourceResource.title) $(li).find(".title").html(val.sourceResource.title);
    			else $(li).find(".title").html("no title present");
    			
    			if(val.sourceResource.description) $(li).find(".description").html(val.sourceResource.description);
    			else $(li).find(".description").html("no description present");
    			
    			if(val.sourceResource.format) $(li).find(".format").html(val.sourceResource.format);
    			else $(li).find(".format").html("no format present");
    			
    			if(val.sourceResource.collection) $(li).find(".collection").html(val.sourceResource.collection.title); 
    			else $(li).find(".collection").html("no collection present");
  
    			if(val.sourceResource.creator) $(li).find(".creator").html(val.sourceResource.creator); 
    			else $(li).find(".creator").html("no creator present");

    			if(val.sourceResource.rights) $(li).find(".rights").html(val.sourceResource.rights); 
    			else $(li).find(".rights").html("no rights present");
    				
    			if(val.isShownAt) $(li).find(".link").html(val.isShownAt);
    			else $(li).find(".link").html("");
    				
    			if(val.sourceResource.date) {
    				if(val.sourceResource.date.displayDate) $(li).find(".date").html(val.sourceResource.date.displayDate); 	
    				else if(val.sourceResource.date.begin) $(li).find(".date").html(val.sourceResource.date.begin); 
    			} else $(li).find(".date").html("no date present");
    			
    			
    			    	    			

    			$(".thumb").mouseenter(function() {
    				$(this).css("opacity", ".6");
    				$(currDiv).find(".hoverdiv").text($(this).find(".title").text());
    			});
    			
    			$(".thumb").mouseleave(function() {
    				$(this).css("opacity", "1");
    				$(currDiv).find(".hoverdiv").text("");

    			});
    				
    			$(".thumb").click(function() {
    				$("li.sub").addClass("hidden");
    				$("li.itemnav").addClass("hidden");

  					if($(this).hasClass("active")) return;
  					$(this).addClass("active");
    				$(".sub").addClass("hidden");
    				zoomLevel++;
    				currDiv = $(currDiv).next();
   					$("#record").addClass("active");
   				
    				var item = $("<div class='itemdiv' />");
    				var url = $(this).css("background-image");
        			url = url.replace('url(','').replace(')','');
    				$(item).append("<div class='col1'><img src='"+url+"'></div>");
    				$(item).append("<div class='col2'>");
    				$(item).find(".col2").append("<b>title: </b>"+$(this).find(".title").text()+"<br />");
    				$(item).find(".col2").append("<b>description: </b>"+$(this).find(".description").text()+"<br />");
    				$(item).find(".col2").append("<b>date: </b>"+$(this).find(".date").text()+"<br />");
    				$(item).find(".col2").append("<b>format: </b>"+$(this).find(".format").text()+"<br />");
    				$(item).find(".col2").append("<b>collection: </b>"+$(this).find(".collection").text()+"<br />");
    				$(item).find(".col2").append("<b>creator: </b>"+$(this).find(".creator").text()+"<br />");
    				$(item).find(".col2").append("<b>rights: </b>"+$(this).find(".rights").text()+"<br />");
    				var link = $(this).find(".link").text();
    				if(link == "") $(item).find(".col2").append("<b>no link present</b>");
    				else $(item).find(".col2").append("<a href='"+link+"' target='_blank'><b>link to original record</b></a></div>");

    				
    				$(currDiv).append(item);
    				
    			});
    			

    			

       					
    			if(zoomLevel == 3) $(currDiv).prepend(li);
   				
				if(currPage > 1) $("#loadless").removeClass("hidden");
				

    			});
    		

					
				});	
		
	}
	
	


	var searchString = new Array();
	
   /* function replaceTreemap() {
        
		var innerField = "provider.name";
		var outerField = "provider.name";
        selectedData = fetchedData;
		selectedData = fetchedData.reduce(function(selected, dataset) { return selected ? selected : dataset.innerField == innerField && dataset.outerField == outerField ? dataset : null; }, null);
        makeTreemap(selectedData);
    }*/


    

    function makeTreemap(data) {
        d3.select('svg').attr('width', 0).attr('height', 0).remove();
      	treemap = d3.layout.treemap()
            .round(false)
            .size([chartWidth, chartHeight])
            .sticky(true)
            .padding([headerHeight + 1, 1, 1, 1])
            .value(function(d) {
                return d.size;
            });

        chart = d3.select('#treemap')
            .append("svg:svg")
            .attr("width", chartWidth)
            .attr("height", chartHeight)
            .append("svg:g");

        node = root = data;
 		var nodes = treemap.nodes(root);
      

        var children = nodes.filter(function(d) {
            return !d.children;
        });
        
        var parents = nodes.filter(function(d) {
            return d.children;
        });
        

		var chart2 = $("#alttree")
		.css("width", chartWidth)
		.css("height", chartHeight);
		
		
                
        //////////
		
        $.each(parents, function(i, val) {
        	if( i != 0) {
        	var newdiv = $("<div>").css("width", val.dx).css("height", val.dy).addClass("kid").attr("id", val.name);
        	var newspan = $("<span>").html(val.name);
        	$(newdiv).attr('data-size', val.size);
            $(newdiv).append(newspan);
        	$(newdiv).css("left", val.x).css("top", val.y);
        	$(newdiv).css("background-color", function() {var x = Math.floor((Math.random()*3)); return colors[x];});
 
        	$(newdiv).addClass("sub");
			$(newdiv).fitText(1,{ minFontSize: '10px', maxFontSize: '30px'});
			$(newdiv).css("line-height", function(d) {var x = $(newdiv).css("font-size"); if(x<10) return 14; else return x; });
			$(newspan).addClass('divtext');
        	 
        	
        	$(currDiv).append(newdiv);
        	}
        });
        
            $(currDiv).append('<div class="hoverdiv sub"></div>');

  			
  			
  		$(".sub").click(function() {
  			if($(this).hasClass("active")) return;
  			$(this).addClass("active");
			if(zoomLevel == 0) {
				searchString.push($(this).text());
				$("#provider-path").text(searchString[0]).css("opacity", 1);

			} else if(zoomLevel == 1) {
				searchString.push($(this).text());
				$("#provider-path").text(searchString[0]).css("opacity", 1);
  				$("#collection-path").text(searchString[1]).css("opacity", 1);

			}
			else if(zoomLevel == 2) {
				searchString.push($(this).text());
				$("#provider-path").text(searchString[0]).css("opacity", 1);
  				$("#collection-path").text(searchString[1]).css("opacity", 1);
				if(searchString[2]) $("#format-path").text(searchString[2]).css("opacity", 1);
  				else $("#format-path").text("Unclassified").css("opacity", 1);
			}
			
			$.each($(".path"), function(i, val) {
				if($(val).html() == "") $(val).html("unclassified");
			});
			
			
  			$(".sub").addClass("hidden");
  			
  			zoomLevel++;

  			currDiv = $(currDiv).next();
  			
  			var a = $(this).text();
  			if($(this).text() == "unclassified") {
  				searchString.pop();
  				searchString.push("");
  			}
  			
			if(zoomLevel == 2) {
				$("#format").addClass("active");
				getPermutations(searchString, "sourceResource.format", a);
				
			
				
			} else if(zoomLevel < 2) {
			
				if(zoomLevel == 1) {
					$("#collection").addClass("active");				
					getPermutations(searchString, "sourceResource.collection.title", a);
				}
				
  				
  			} else if(zoomLevel == 3) {
  			
  				$("#objects").addClass("active");
  	
				$("#four").html("");
				currPage = 1;
  				loadNewQuery(searchString, false, 1);
  				$(".loading").remove();
  				
  				
  				
  				
				var ll = $('<li class="itemli itemnav hidden" id="loadless"/>');  			
				$(ll).css('width',"60px");
    			$(ll).css('height',"60px");	
    			$(ll).css('background-color', 'black');
    			$(ll).css('color', 'white');  		
    			$(ll).append("<span class='next'>&#60;</span>");
    			$(ll).fitText();
    			$(currDiv).append(ll);
    				
    			
    				
    			var l2 = $('<li class="itemli itemnav hidden" id="pagecount"/>');
    			$(l2).append("<div class='counttext'>PAGE <span id='partcount'></span> / <span id='wholecount'></span></div>");
    			$(l2).css('height',"60px");	
    			$(l2).css('background-color', 'black');
     			$(l2).css('color', 'white');     				
    			$(currDiv).append(l2);

			    var lm = $('<li class="itemli itemnav hidden" id="loadmore"/>');  			
				$(lm).css('width',"60px");
    			$(lm).css('height',"60px");	
    			$(lm).css('background-color', 'black');
     			$(lm).css('color', 'white');  		
    			$(lm).append("<span class='next'>&#62;</span>");
    			$(lm).fitText();
    			$(currDiv).append(lm);
    			
    			$(currDiv).append("<div class='loading'>loading...</div>");
				$(currDiv).append('<div class="hoverdiv sub"></div>');

    				
  			}
  			
  		$("#loadless").click(function() {
			
			$(currDiv).find(".thumb").addClass("hidden");
			currPage = currPage - 1;
			$("."+currPage).removeClass("hidden");
			if(currPage == 1) $(this).addClass("hidden");
			$("#loadmore").css("opacity", 1);
			$("#partcount").html(currPage);
					
		});
				
		$("#loadmore").click(function() {
			if(currPage != $("#wholecount").text()) {
				$("."+currPage).addClass("hidden");
				currPage = currPage+1;		
				if($("."+currPage).length > 0){
					$("."+currPage).removeClass("hidden");
					$("#partcount").html(currPage);
				} else loadNewQuery(searchString, false);
			}
		});
		
		$("#loadmore").mouseenter(function() {
			$(this).css("background-color", "#FF1E00");
		});
  		$("#loadmore").mouseleave(function() {
  			$(this).css("background-color", "#000000");
  		});
		$("#loadless").mouseenter(function() {
			$(this).css("background-color", "#FF1E00");
		});
  		$("#loadless").mouseleave(function() {
  			$(this).css("background-color", "#000000");
  		});
  		
  		
		$(".label").click(function() {
			if(zoomLevel == 0) return;
			$(currDiv).html("");
			currDiv = $(currDiv).prev();
			zoomLevel--;

			$(".nav.active").last().removeClass("active");
			
			if(zoomLevel == 3) {
				$(currDiv).find("."+currPage).removeClass("hidden");
				$(".itemnav").removeClass("hidden");
				if(currPage == 1) $("#loadless").addClass("hidden");			
			} else $(currDiv).find("div").removeClass("hidden");
			$(currDiv).find("div").removeClass("active");	
			searchString.pop();

		});
  			
  	});
 

		 		
  		$(".sub.kid").mouseenter(function() {
  			$(this).css("background-color", "#FF1E00");
  			$(currDiv).find(".hoverdiv").text($(this).text());
  		});
  		$(".sub.kid").mouseleave(function() {
  			$(this).css("background-color", function() {var x = Math.floor((Math.random()*3)); return colors[x];});
  			$(currDiv).find(".hoverdiv").text("");
  		});
  		

        
    }
	
	
function getPermutations(searchBase, field, objval) {

	$(currDiv).append("<div class='loading'>loading...</a>");
		
		
		
		$.ajax({url: "pull_data.php", type: 'post', async: 'false', data: {search1: searchBase[0], search2: searchBase[1], search3: searchBase[2], page: 1, level: zoomLevel}}).done( function(provjson_raw) {
			var thisColl = new Object();
			thisColl.name = objval;
			thisColl.innerField = field;
			thisColl.outerField = field;

			thisColl.children=new Array();

			var provjson = neatenJSON(provjson_raw);


			$.each(provjson.facets[field]["terms"], function(j, provBucket) {
				var obj = new Object();
				obj.children = new Array();
				var kid = new Object();			
				var value = provBucket.term;
				obj.size = provBucket.count;
				obj.name = value;					

				
				kid.name = value;
				kid.size=provBucket.count;
				obj.children.push(kid);
				
				thisColl.children.push(obj);
												
			});
			if(provjson.facets[field]["terms"].length == 0) {
				var obj = new Object();
				obj.children = new Array();
				var kid = new Object();			
				var value = "unclassified";
				obj.size = provjson.count;
				obj.name = value;		
				kid.name = value;
				kid.size=provjson.count;
				obj.children.push(kid);
				
				thisColl.children.push(obj);			 
			}
			
			
			currDiv.html("");
			makeTreemap(thisColl);
		
		});	
}


   
    
    function neatenJSON(data) {
		var q = data.query;
		var results = $.parseJSON(data).results;		
		var newJSON = $.parseJSON(results);
		var count = newJSON.count;
	
		var formatted = "";
				
		for(var i = 0; i < count; i++)
		{
			if(!newJSON.docs[i] || !newJSON.docs[i].originalRecord)
			{
				continue;
			}
				
			formatted += "<h2>" + newJSON.docs[i].originalRecord.subject + "</h2>" + newJSON.docs[i].originalRecord.description + "<br><br>";
			if(typeof newJSON.docs[i].provider !== 'undefined')
				formatted += "<strong>DPLA Contributor:</strong> " + newJSON.docs[i].provider.name + "<br>";
				formatted += "<hr>";
			}
			return newJSON;
	}
</script>
</html>
