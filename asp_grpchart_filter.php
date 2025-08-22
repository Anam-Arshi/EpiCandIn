<!doctype html>
<?php
error_reporting(0); 
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<!-- Load d3.js -->
<script src="https://d3js.org/d3.v6.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css"> 
<!-- Create a div where the graph will take place -->
<div id="groupedbar" align="center"></div>	
	
<style>
	.legend {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 60%;
}

rect {
    stroke-width: 2;
}

text {
  font: 10px Verdana, "sans-serif";
}
	
	</style>

</head>

<body>
<?php
	
 
include("connect.php");     #$get_co = mysqli_query($conn, "select distinct comorbidities from sps_prevalence where study_ids = '$st_id';");
if($spp != "Overall"){
$get_dr = mysqli_query($conn, "select distinct Drug from asp where study_ids = '$st_id' and $i != '0' and Species = '$spp';");	
}else{
	$get_dr = mysqli_query($conn, "select distinct Drug from asp where study_ids = '$st_id' and $i != '0' and Category = '$spp';");	

}
	unset($dr);
	while($dru=mysqli_fetch_array($get_dr)){
		$dr[] = $dru["Drug"];
	    #$pr = $dru[$i];
	}
	
	#foreach($get as $i){
	unset($val_csv);
	if(($rowcount == 2)){
	$dc1 = $dc[0];
	$dc2 = $dc[1];
	
	
	$val_csv = "drugs,$dc1,$dc2".'\n';
	
	
	
	foreach($dr as $val){
		if($spp != "Overall"){
			$res1 = mysqli_query($conn, "select $i, Drug from asp where Disease_Category='$dc1' and Drug='$val' and study_ids = '$st_id' and $i != '0' and Species='$spp'");
		    $res2 = mysqli_query($conn, "select $i, Drug from asp where Disease_Category='$dc2' and Drug='$val' and study_ids = '$st_id' and $i != '0' and Species='$spp'");
		    
            
		    unset($per1);
			while($row1= mysqli_fetch_array($res1)){
				
				$per1 = $row1[$i];
				
			}
		    unset($per2);
		    while($row2= mysqli_fetch_array($res2)){
				
				$per2 = $row2[$i];
			}
		    
		   
		$val_csv = "$val_csv$val,$per1,$per2".'\n';
		
		}
		else
		if($spp == "Overall"){
			
			$res1 = mysqli_query($conn, "select $i, Drug from asp where Disease_Category='$dc1' and Drug='$val' and study_ids = '$st_id' and $i != '0' and Category='$spp'");
		    $res2 = mysqli_query($conn, "select $i, Drug from asp where Disease_Category='$dc2' and Drug='$val' and study_ids = '$st_id' and $i != '0' and Category='$spp'");
		    
            
		    unset($per1);
			while($row1= mysqli_fetch_array($res1)){
				
				$per1 = $row1[$i];
				
			}
		    unset($per2);
		    while($row2= mysqli_fetch_array($res2)){
				
				$per2 = $row2[$i];
			}
		    
		   
		$val_csv = "$val_csv$val,$per1,$per2".'\n';
		}
	
	

	}
	
	 #echo $val_csv; 
if (preg_match('~[1-9]+~', $val_csv)) {
?>
<script>  
var grp = "<?php echo $i;?>"
var sp = "<?php echo $spp;?>";      
// set the dimensions and margins of the graph
var margin = {top: 100, right: 150, bottom: 120,left: 70},
    width = 600 - margin.left - margin.right,
    height = 600 - margin.top - margin.bottom;

	
// append the svg object to the body of the page
var svg = d3.select("#main-sidebar")
  .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform",`translate(${margin.left},${margin.top})`);

// Parse the Data 
	
//d3.csv("<?php #echo $rafln; ?>").then( function(data) {
	
	 //var parsed = "<?php #echo $val_csv;?>";
	
	var data = d3.csvParse("<?php echo $val_csv;?>", function(d) { 
		return d;
	});
	console.log(data);

 var hvall = data.map(d => +Object.values(d)[1]);
 var hval = data.map(d => +Object.values(d)[2]);
 var hv = hvall.concat(hval);
 console.log(hv);

  // List of subgroups = header of the csv files = soil condition here
	
  var subgroups1 = data.columns.slice(1)
  console.log(subgroups1.length);
  var subgroups = subgroups1.map(function(d){
	if(d != undefined){
		return d;
	}  
  })
  console.log(subgroups);

	var val = subgroups.forEach(function(d){return data[d];})
	console.log(val)
  // List of groups = species here = value of the first column called group -> I show them on the X axis
  var groups = data.map(d => d.drugs)
    console.log(groups);                                                       

  var tooltip = d3.select("#groupedbar")
    .append("div")
    .style("opacity", 0)
    .attr("class", "tooltip")
    .style("background-color", "white")
    .style("border", "solid")
    .style("border-width", "2px")
    .style("border-radius", "5px")
    .style("padding", "5px")
	.style("position", "absolute")
	.style("width", "50px")
  

  // Add X axis
  var x = d3.scaleBand()
      .domain(groups)
      .range([0, width])
      .padding([0.2])
  svg.append("g")
    .attr("transform", `translate(0, ${height})`)
    .call(d3.axisBottom(x).tickSize(2))
	.selectAll("text")  
		  .attr("transform", "rotate(-40)")
		  .style("text-anchor", "end")
        .attr("dx", "-0.8em")
        .attr("dy", "0.5em")
		.style("font-size", "13px");
	
	  
	  svg.append("text")      // text label for the x axis
			.attr("x", width/1.7 )
			.attr("y", height + 110)
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.style("font-weight", "bold")
	        .attr("fill", "#000")
			.text("Drugs");

var vall = +d3.max(hv) + 5;
console.log(vall);

  // Add Y axis
  var y = d3.scaleLinear()
    .domain([0, vall])
    .range([ height, 0 ]);
  svg.append("g")
    .call(d3.axisLeft(y))
	.selectAll("text")
	.style("font-size", "13px")
	svg.append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 15)
        .attr("dy", "-4em")
	    .attr("x", -90)
	    .attr("fill", "#000")    
        .style("text-anchor", "end")
	     .style("font-size", "15px")
	    .style("font-weight", "bold")
        .text(function(d){
		if(grp == 'R'){
		return "Resistance (%)";
		}else if(grp == 'S'){
			return "Sensitivity (%)";
		}else if(grp == 'I'){
			return "Intermediate (%)";
		}
		
	});

/*svg.append("text")
       .attr("transform", "translate(100,0)")
       .attr("x", 100)
       .attr("y", -30)
       .style("font-size", "15px")
	   .style("font-weight", "bold")
	   .text(function(d){
		if(grp == 'R'){
		return "Resistance - "+sp;
		}else if(grp == 'S'){
			return "Sensitive - "+sp;
		}else if(grp == 'I'){
			return "Intermediate - "+sp;
		}
		
	});*/
  // Another scale for subgroup position?
  var xSubgroup = d3.scaleBand()
    .domain(subgroups)
    .range([0, x.bandwidth()])
    .padding([0.05])

  // color palette = one color per subgroup
  var color = d3.scaleOrdinal()
    .domain(subgroups)
    .range(['#045469','#5AB4CC']);
  

  // Three function that change the tooltip when user hover / move / leave a cell
  var mouseover = function(event,d) {
    tooltip
      .style("opacity", 1)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 2)
      .style("opacity", 1)
  }
  var mousemove = function(event,d) {
    tooltip
      //.html(d.key+"<br>" + Math.round(d.value * 10)/ 10+"%")
	  .html(Math.round(d.value * 10)/ 10+" %")
      .style("left", (event.x)/1 + 50 + "px")
      .style("top", (event.y)/1 - 150 + "px")
  }
  var mouseleave = function(event,d) {
    tooltip
      .style("opacity", 0)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 0)
      .style("opacity", 1)
  }

  
  
  // Show the bars
  svg.append("g")
    .selectAll("g")
    // Enter in data = loop group per group
    .data(data)
    .join("g")
      .attr("transform", d => `translate(${x(d.drugs)}, 0)`)
    .selectAll("rect")
    .data(function(d) {return subgroups.map(function(key) { return {key: key, value: d[key]}; }); })
    .join("rect")
      .attr("x", d => xSubgroup(d.key))
      .attr("y", d => y(d.value))
      .attr("width", xSubgroup.bandwidth())
      .attr("height", d => height - y(d.value))
      .style("fill", function(d){return color(d.key)})
	  .on("mouseover", mouseover)
     .on("mousemove", mousemove)
     .on("mouseleave", mouseleave)
	  
            
	var legend = svg.selectAll(".legend")
	   .data(subgroups)
        .enter().append("g")
        .attr("class", "legend")
        .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

    legend.append("rect")
        .attr("x", width + 10)
        .attr("width", 18)
        .attr("height", 18)
        .style("fill", color);

    legend.append("text")
        .attr("x", width + 30)
        .attr("y", 9)
        .attr("dy", ".35em")
        .style("text-anchor", "start")
	    .style("font-size", 12)
        .text(function(d) { return d; });
	
	
//});
</script>
<?php
	}
	}
?>

</body>
</html>

