<!doctype html>
<html>
<head>
<meta charset="utf-8">

<script src = "d3.js_package/dist/d3.js"></script>
<script src = "d3.js_package/dist/d3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

<link rel="stylesheet" href="css/style.css" type="text/css"> 

<script type="text/javascript" src="map_master/js/d3.min.js"></script>
<script type="text/javascript" src="map_master/js/d3.geo.min.js"></script>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-geo-projection.v2.min.js"></script>

<script src="https://d3js.org/d3-array.v2.min.js"></script>
	
<style>
	g{
		cursor: pointer;
		
	}
	
	
	</style>
	
	
</head>

<body>
<div id="tool">

</div>
<h3>Geographic distribution</h3>
<?php
include("connect.php");     $res=mysqli_query($conn, "select DISTINCT state_city.city from state_city;");
	
foreach($res as $val){
$city1[] = $val["city"];
}

$city = array_map('trim', $city1);
#var_dump($city);

	
$st = mysqli_query($conn, "SELECT state_ut, COUNT(state_ut) as cont FROM state_city GROUP BY state_ut");
$dat = "";

while($row=mysqli_fetch_array($st)){
	$val = $row["state_ut"]; 
	$cnt = $row["cont"];
	
	$dat = $dat." [{"."state: ".$val." ,"."value: ".$cnt."}]";
	 
}
	#echo $dat;
?>
	

<svg id="svg1"></svg>
<script type="text/javascript">
//https://cdn.anychart.com/geodata/2.1.1/countries/india/india.js - json/geo data India
// https://bl.ocks.org/anilnairxyz/raw/11190f144a89b54c6698699f3a83b315/IND_adm2_Literacy.json
    var w = 600;
    var h = 600;
    var proj = d3.geo.mercator();
    var path = d3.geo.path().projection(proj);
    var t = proj.translate(); // the projection's default translation
    var s = proj.scale() // the projection's default scale

    var svg = d3.select("#site_map")
             .select("#svg1")
             .attr("width", w)
        .attr("height", h)
        .call(initialize);

    var map = svg.append("svg:g")


    var india = map.append("svg:g")
        .attr("id", "india")
        .style('stroke','#000')
        .style('stroke-width','0.5');

   

//var dat = [{state: 'Maharashtra', value: 14},{state: 'Keral', value: 5}];


//var range = ["#F8CAEE","#BF76AF","#852170"]"rgb(158,202,225)";
var color = "#81DAF6";

var tooltip = d3.select("#tool")
	.append("div")
    .style("opacity", 0)
    .attr("class", "tooltip")
    .style("background-color", "#53565b")
    .style("border", "solid white")
    .style("border-width", "2px")
    //.style("border-radius", "5px")
    .style("padding", "5px")
	.style("position", "absolute" )
	.style("color", "white")
	//.style("font-weight", "bold")
	.style("font-size", "16px")
	.style("width", "auto")
	.style("padding", "5px")
	
var handleMouseOver= function(d) {
	 tooltip
      .style("opacity", 1)
  d3.select(this).attr("stroke-width","1.4").style("fill", "#0BA1EF");
  //d3.selectAll("g").style("opacity", .05);
}
var handleMouseMove= function(d){
tooltip
      .html("<b>"+d.id+"</b><br>"+"Records: "+d.count)
      .style("left", d3.event.pageX + 10 + "px")
	  .style("top", d3.event.pageY + 10 +"px")	
}

var handleMouseOut = function(d) {
	tooltip
      .style("opacity", 0)
  d3.select(this).attr("stroke-width","0.5").style("fill", color);
  //d3.selectAll("g").style("opacity", 1)
}



    d3.json("map_master/data/full_data-1.json", function (json) {
      india.selectAll("path")
          .data(json.features)
        .enter().append("path")
          .attr("d", path)
		  .style("fill", color)
		
		
		  .on("click", function (d) { 
		  var value = d.id;
		  if(d.count != "Not available"){
		  window.open("state_wise_data.php?val="+value, "_self")} })
		   
          .on("mouseover", handleMouseOver)
          .on("mouseout", handleMouseOut)
		  .on("mousemove", handleMouseMove)
          
          //.text(function(d){return d.id+"\n"+ "Records: "+d.count;})
		
		
		
    });
	



    function initialize() {
      proj.scale(6700);
      proj.translate([-1240, 750]);
    }

var city = <?php echo '["' . implode('", "', $city) . '"];' ?>;

d3.json("map_master/data/indian_cities_database.json", function(cities){
  
var cit = [];
var d = {};
for(const e of city){
	d = cities.RECORDS.filter(function(d){return d.City == e;});
	cit.push(...d);
}

console.log(cit);  
// add circles to svg
    map.selectAll("circle")
		.data(cit).enter()
		.append("circle")
		.attr("cx", function(d){console.log([d.Long, d.Lat]); return proj([d.Long, d.Lat])[0]; })
		.attr("cy", function(d){console.log(proj([d.Long, d.Lat])); return proj([d.Long, d.Lat])[1]; })
		.attr("r", "3px")
		.attr("fill", "rgb(8,48,107)")
		.on("click", function (d) { 
		  var cit_name = d.City;
		  window.open("city_wise_table.php?cit="+cit_name, "_self") })
		  
		.on("mouseover", function(d){
          d3.select(this).attr("r","5px").style('fill',"orange");
		  tooltip
      .style("opacity", 1)
	  .style("font-weight", "bold")
        })
		.on("mousemove", function(d){
			tooltip
      .html(d.City)
      .style("left", d3.event.pageX + 10 + "px")
	  .style("top", d3.event.pageY + 10 +"px")
		})
        .on("mouseout", function(d) {
          d3.select(this).attr("r","3px").style("fill",'rgb(8,48,107)');
		  tooltip
      .style("opacity", 0)
	  .style("font-weight", "normal")
        })
        /* .append("title")
        .text(function(d){
          return d.City;
        }) */



});


  //.attr("fill", d => d.technology === "D3.js" ? "yellowgreen" : "skyblue");

</script>
	
</body>
</html>