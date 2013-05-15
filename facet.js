

var api_key = "cbb27864d49127519ea744deca8744e0";

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

var dpla = new Array();
function getPermutations() {


		

		$.ajax({url: "pull_data.php", type: 'post', async: 'false', data: {search: "", facet: "provider.name", lim: 0}}).done( function(provjson_raw) {

			var allProvs = new Object();
			allProvs.name = "DPLA";
			allProvs.innerField = "provider.name";
			allProvs.outerField = "provider.name";

			allProvs.children=new Array();

			var provjson = neatenJSON(provjson_raw);		
			$.each(provjson.facets["provider.name"]["terms"], function(j, provBucket) {
				var value = provBucket.term;
				
				var prov = new Object();
				prov.name = value;

				prov.size = provBucket.count;
				prov.children = new Array();
				
				var obj = new Object();
				obj.name = value;
				obj.size=provBucket.count;
				prov.children.push(obj);
				
				allProvs.children.push(prov);
				
				var indivProv = new Object();
				indivProv.name = value;
				indivProv.innerField = "sourceResource.collection.title";
				indivProv.outerField = "sourceResource.collection.title";

				indivProv.children = new Array();
								
		
				var search = "provider.name="+value;
				$.ajax({url: "pull_data.php", type: 'post', async: 'false', data: {search: search, facet: "sourceResource.collection.title", lim: 0}}).done( function(colls_raw) {
					var colls = neatenJSON(colls_raw);
					$.each(colls.facets["sourceResource.collection.title"]["terms"], function(k, collBucket) {
						var collval = collBucket.term;
						
						var coll = new Object();
						coll.name = collval;

						coll.size = collBucket.count;
						coll.children = new Array();
						
						var collkid = new Object();
						collkid.name = collval;
						collkid.size = collBucket.count;
						coll.children.push(collkid);
						
						indivProv.children.push(coll);
						console.log(coll);
						/*
						var indivColl = new Object();
						indivColl.name = collval;
						indivColl.field = "sourceResource.format";
						indivColl.children = new Array();
						
						var searchtwo = "sourceResource.collection.title="+collval+"&provider.name="+value;
						
						$.ajax({url: "pull_data.php", type: "post", async: 'false', data: {search: search, facet: "sourceResource.format", lim: 0}}).done( function(forms_raw) {
							var formats = neatenJSON(forms_raw);				
							$.each(formats.facets["sourceResource.format"]["terms"], function(l, formBucket) {
								var form = new Object();
								form.name = formBucket.term;
								form.size = formBucket.count;
								form.field="sourceResource.format";
								form.children = new Array();
								
								var formkid = new Object();
								formkid.name = formBucket.term;
								formkid.size = formBucket.count;
								form.children.push(formkid);
								
								indivColl.children.push(form);
								
								console.log(form);
							
							});
							
							dpla.push(indivColl);
							

						});

						*/
					});
									
					dpla.push(indivProv);

				});
				

			});     
		
			dpla.push(allProvs);
		});	
}

getPermutations();