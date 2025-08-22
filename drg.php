<!doctype html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>
<p  align="center" style="margin: 0px;"><b>Antifungal drugs prescribed for treatment</b></p>
<canvas id="drg" style="width:100%;max-width:1200px; padding: 30px;" align="center"></canvas>
<?php 
include "connect.php";
	
$ai=0;	


$res=mysqli_query($conn, "SELECT drug, COUNT(DISTINCT Study_ids) as cont FROM drug GROUP BY drug;;");
$count = mysqli_num_rows($res);
	
if($count > 0)
{

while($row = mysqli_fetch_array($res))
{
	$cnt=$row["cont"];
	$yr = $row["drug"];
	if($cnt>0)
	{
	if($ai==0)
	{
	$yval=$cnt;
	$xval="'$yr'";
	}
	else
	{
		$yval=$yval.", ".$cnt;
		$xval="$xval, '$yr'";
	}
	$ai++;
	}
}
}

//echo $xval;
//echo $yval;
//print_r($xval);
?> 
<script>
var xValues = [<?php echo $xval; ?>];
var yValues = [<?php echo $yval; ?>];
//var barColors = ["#8ecafb"];

new Chart("drg", {
   type: "horizontalBar",
  data: {
    labels: xValues, 
    datasets: [{
	//label: "Upto year 2000",
      backgroundColor: "#16AEDB",
		hoverBackgroundColor: "#0C8EB2",
      data: yValues,
		
		
    }]
  },
	options: {
        scales: {
            xAxes: [{
                ticks: {
            		beginAtZero: true,
					
					fontSize: 13,
				
                },
				scaleLabel: {
        display: true,
        labelString: 'No. of publications',
		fontSize: 15,
        fontColor: "black",
		fontWeight: 100
      }
            }],
            yAxes: [{
            	stacked: true,
				scaleLabel: {
        display: true,
        labelString: 'Antifungal drugs',
		fontSize: 15,
        fontColor: "black",
		fontWeight: 100,
	    //fontStyle: "italic"
      },
				ticks: {
				fontSize: 13,
				}
				
				
            }]
        },
		legend: {
        position: 'right',
		display: false
      },
		title: {
      display: true,
      //text: "Antifungal drugs prescribed for treatment", (Period: 1972-2022)
	  text : "1972-2022",	
	  fontSize: 13,
        fontColor: "black",
		fontWeight: 100,
    },
  /*options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Upto year 2000"
    },
	 yAxes: [{
		 ticks: {
			 beginAtZero: true
		 }
	 }]*/
  }
});
</script>

</body>
</html>