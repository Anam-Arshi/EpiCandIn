

 <script>
	 var drr = "<?php echo $drr;?>";
// set the dimensions and margins of the graph
var margin = {top: 50, right: 170, bottom: 100, left: 80},
    width = 500 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;
	
	var data = d3.csvParse("<?php echo $val_csv;?>", function(d) { 
		return d;
	});
	console.log(data);
 var hvall = data.map(d => +Object.values(d)[1]);
 var hval = data.map(d => +Object.values(d)[2]);
 var hv = hvall.concat(hval);
 console.log(hv);
	// append the svg object to the body of the page
var svg = d3.select("#graphs")
  .append("svg")
    .style("padding", "12px")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform",`translate(${margin.left},${margin.top})`);
			  
	var subgroups1 = data.columns.slice(1)
	console.log(subgroups1.length);
	var subgroups = subgroups1.map(function(d){
	if(d != undefined){
	return d;
	}  
	})
  console.log(subgroups);

  // List of groups = species here = value of the first column called group -> I show them on the X axis
  var groups = data.map(d => d.activity)
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
	.style("width", "150px")
  

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
	      .attr("font-weight", "normal")
        .attr("dx", "-0.8em")
        .attr("dy", "0.5em")
		.style("font-size", "13px")
	
	  
	  svg.append("text")      // text label for the x axis
			.attr("x", width/2 )
			.attr("y", height + 130 )
			.style("font-size", "15px")
			.style("text-anchor", "end")
			.style("font-weight", "normal")
	        .attr("fill", "#000")
			//.text("Species");
	 
svg.append("text")
		.attr("align", "center")
       .attr("transform", "translate(10,0)")
       .attr("x", 95)
       .attr("y", -35)
       .style("font-size", "15px")
	   .style("font-weight", "bold")
	   .attr("fill", "#000")
	   .text("Drug: "+drr);
	 
//var vall = +d3.max(hv) + 10;
	 if(+d3.max(hv) < 100){
		 
		 var vall = +d3.max(hv) + 10;
		
		}else{
			 var vall = +d3.max(hv);
		 }
	 
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
        .attr("y", 18)
        .attr("dy", "-4em")
	     .attr("x", -100)
	    .attr("fill", "#000")
         .style("font-weight", "bold")
        .style("text-anchor", "end")
	     .style("font-size", "15px")
        .text("Percentage");


  // Another scale for subgroup position?
  var xSubgroup = d3.scaleBand()
    .domain(subgroups)
    .range([0, x.bandwidth()])
    .padding([0.05])

  // color palette = one color per subgroup
  var color = d3.scaleOrdinal()
    .domain(subgroups)
    .range(['#045469','#5AB4CC', '#0D9BC0']);
  

  // Three function that change the tooltip when user hover / move / leave a cell
  var mouseover = function(d) {
    tooltip
      .style("opacity", 1)
    d3.select(this)
      .style("stroke", "black")
	  .style("stroke-width", 2)
      .style("opacity", 1)
  }
  var mousemove = function(d) {
	  
    tooltip
      .html(d.key+"<br>" + Math.round(d.value * 10)/ 10+"%")
      .style("left", (event.pageX)- 50 + "px")
      .style("top", (event.pageY)- 150 + "px")
  }
  var mouseleave = function(d) {
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
      .attr("transform", d => `translate(${x(d.activity)}, 0)`)
    .selectAll("rect")
    .data(function(d) { console.log('data bound to rect:', d); return subgroups.map(function(key) { return {key: key, value: d[key]};  }); })
    .join("rect")
      .attr("x", d => xSubgroup(d.key))
      .attr("y", d => y(d.value))
      .attr("width", xSubgroup.bandwidth())
      .attr("height", d => height - y(d.value))
      .style("fill", function(d){return color(d.key);})
	  .on("mouseover", mouseover)
     .on("mousemove", mousemove)
     .on("mouseleave", mouseleave);
	  
	 console.log(subgroups);
            
	var legend = svg.selectAll(".legend")
	   .data(subgroups)
        .enter().append("g")
        .attr("class", "legend")
        .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

    legend.append("rect")
        .attr("x", width + 10)
        .attr("width", 12)
        .attr("height", 12)
        .style("fill", color);

    legend.append("text")
        .attr("x", width + 25)
        .attr("y", 7)
        .attr("dy", ".35em")
        .style("text-anchor", "start")
		.style("font-size", 12)
        .text(function(d) { return d; });

	// Assume you have a D3.js graph already created and stored in the variable 'svg'

// Select the SVG element
var svgElement = d3.select('svg');

// Create a function to convert SVG to PNG
function downloadGraph() {
  // Get the SVG element as a string
  var svgString = new XMLSerializer().serializeToString(svgElement.node());

  // Create a canvas element to convert SVG to an image
  var canvas = document.createElement('canvas');
  var context = canvas.getContext('2d');

  // Create an Image element
  var image = new Image();
  image.onload = function () {
    // Set canvas dimensions to match the SVG element
    canvas.width = svgElement.attr('width');
    canvas.height = svgElement.attr('height');

    // Draw the SVG onto the canvas
    context.drawImage(image, 0, 0);

    // Convert canvas to data URL and create a download link
    var dataURL = canvas.toDataURL('image/png');
    var downloadLink = document.createElement('a');
    downloadLink.href = dataURL;
    downloadLink.download = drr+'.png';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  };

  // Set the source of the Image element to the SVG string
  image.src = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgString);
}



// Add an SVG group (g element) for the download icon
var downloadGroup = svg.append('g')
  .attr('transform', 'translate(400, -45)'); // Adjust the position as needed

// Create an icon using the Font Awesome classes
downloadGroup.append('foreignObject')
  .attr('width', 20) // Adjust the size as needed
  .attr('height', 20)
	 .attr('title', 'Download')
   .style('color', "darkgray")
	 .style("cursor", "pointer")
  .html('<i class="fas fa-download"></i>');

// Add a click event listener to trigger the download
downloadGroup.on('click', downloadGraph);




//});
</script>
