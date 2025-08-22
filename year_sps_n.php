<!doctype html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<style>
	.year{
		margin-right: 80px;
		float: right;
	}
	.title{
		font-size: 16px;
		font-weight: bold;
		display: inline;
		margin-left: 270px;
		}
</style>
</head>
<body>
<?php
$yop ="default";
	if(isset($_POST["yop_s"]))
	{
     $yop = $_POST["yop_s"];
	}
if($yop == "")
{
	$yop="default";
}
?>
<p class="title"><em>Candida</em> species associated with infections </p>

<div align="center" class="year">

<form action="#" method="post">
<label>Select decade</label>
<select name="yop_s" onChange="this.form.submit()">
<option value="default" <?php if($yop == "default"){ echo "selected";} ?> >1972-2022</option>
<option value="< 2001" <?php if($yop == "< 2001"){ echo "selected";} ?> >Upto 2000</option>
<option value="2001 AND 2010" <?php if($yop == "2001 AND 2010"){ echo "selected";} ?>>2001-2010</option>	
<option value="2011 AND 2020" <?php if($yop == "2011 AND 2020"){ echo "selected";} ?>>2011-2020</option>	
<option value="> 2020" <?php if($yop == "> 2020"){ echo "selected";} ?>>After 2020</option>	

</select>
</form>
</div>

<canvas id="year_sps" align="center" style="width:100%;max-width:1200px; padding: 30px;"></canvas>
<?php 
include "connect.php";
	
$ai=0;	


$ni = mysqli_query($conn, "SELECT distinct species from sps_prevalence order by species");
while($ni_res = mysqli_fetch_array($ni))
{
	$val=trim($ni_res["species"]);
	
	if(strpos($yop, '<') !== false)
	{
	$qry = "SELECT count(DISTINCT data.Study_ids) as cont FROM sps_prevalence INNER JOIN data ON sps_prevalence.study_ids = data.study_ids where sps_prevalence.species LIKE '%$val%' and data.Year_of_Publication $yop";
	$title = "Upto 2000";
	}
	else if(strpos($yop, ">") !== false){
		$qry = "SELECT count(DISTINCT data.Study_ids) as cont FROM sps_prevalence INNER JOIN data ON sps_prevalence.study_ids = data.study_ids where sps_prevalence.species LIKE '%$val%' and data.Year_of_Publication $yop";
		$title = "After 2020";
	}
	else if(strpos($yop, "AND") !== false){
		$qry = "SELECT count(DISTINCT data.Study_ids) as cont FROM sps_prevalence INNER JOIN data ON sps_prevalence.study_ids = data.study_ids where sps_prevalence.species LIKE '%$val%' and data.Year_of_Publication $yop";
		if($yop == "2001 AND 2010"){
			$title = "2001-2010";
		}
		else{
			$title = "2011-2020";
		}
	}
	if($yop == "default"){
        	$qry = "SELECT count(DISTINCT data.Study_ids) as cont FROM sps_prevalence INNER JOIN data ON sps_prevalence.study_ids = data.study_ids where sps_prevalence.species LIKE '%$val%'";
    $title = "1972-2022";
	
      }
	
	//echo $qry;
	//echo "SELECT Year_of_Publication, count(DISTINCT Study_ids) as cont FROM data where Niche_Infected LIKE '%$val%' and Year_of_Publication < 2001 GROUP BY Year_of_Publication";
$res=mysqli_query($conn, $qry);
$count = mysqli_num_rows($res);
if($count > 0)
{

while($row = mysqli_fetch_array($res))
{
	$cnt=$row["cont"];
	if($cnt >0){
	if($ai==0)
	{
	$yval=$cnt;
	$xval="'$val'";
	}
	else
	{
		$yval=$yval.", ".$cnt;
		$xval="$xval, '$val'";
	}
	$ai++;
	}
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
var title = "<?php echo $title;?>";
var max = Math.max(...yValues)+2;
//var barColors = ["#8ecafb"];

new Chart("year_sps", {
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
					fontSize:13,
					precision: 0,
					//max: max
                },
				scaleLabel: {
        display: true,
        labelString: 'No. of publications',
		fontSize: 15,
        fontColor: "black",
		fontWeight: 300
      }
            }],
            yAxes: [{
            	stacked: true,
				ticks: {
            		fontSize:13,
					fontStyle: "italic",
                },
				
				scaleLabel: {
        display: true,
        labelString: 'Species',
		fontSize: 15,
        fontColor: "black",
		fontWeight: 300,
	    
      }
				
				
            }]
        },
		legend: {
        position: 'right',
		display: false
      },
		title: {
      display: true,
      text: title,
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