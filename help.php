<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Help</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
	main{
		padding: 10px;
	}
</style>
	
<style>
.tableFixHead {
        overflow-y: auto; /* make the table scrollable if height is more than 200 px  */
        height: 200px; /* gives an initial height of 200px to the table */
	    width: 70%;
      }
      .tableFixHead thead th {
        position: sticky; /* make the table heads sticky */
        top: 0px; /* table head will be placed from the top of the table and sticks to it */
      }
table{
	border-collapse: collapse;
	
	margin-right: 0px;
	
	width: 100%;
	
  
	}	
	.heading{
		background-color: #5D9EC0;
		color: black; 
		border: 0;
	}
	.heading th{
		border: 0;
		background-color: #5D9EC0;
	}
	td{
		
	}
</style>

</head>

<body>
<?php
	include("header2.php")
?>
<main>
<h2 align="center">Help</h2>
<h3>1. Home page</h3>
<p>
EpiCandIn has been created to track the epidemiology of candidiasis in India. It is a collection of manually curated publications that report the data on candidiasis such as <em>Candida</em> species, geographical location, niche affected, disease characteristics and drug therapy details.<br><br>
Data can be retrieved using the given quick links on the webpage.
</p>
<img src="images/quick_links.JPG" width="600px" height="200px"></img>	
<p>
1. a) <em>Candida</em> species	<br><br>
The page shows sidebar filter for columns and species which user can use to filter the table based on species and selected columns.
</p>
<img src="images/species.JPG" width="700px" height="300px"></img>
<p>
1. b) Niche infected<br><br>
The page shows sidebar filter for columns and niche which user can use to filter the table based on niche and selected columns.
</p>
<img src="images/niche.JPG" width="700px" height="300px"></img>
<p>
1. c) Antifungal drugs<br><br>
The page shows sidebar filter for columns and drugs which user can use to filter the table based on drugs and selected columns.
</p>
<img src="images/drugs.JPG" width="700px" height="300px"></img>
<p>
1. d) Geographical distribution<br><br>
There is a dynamic map of India on the right side of homepage which is clickable and shows number of records on hovering.
</p>
	
<img src="images/map.JPG" width="600px" height="600px"></img>

<h3>2. Search</h3>
<img src="images/search.JPG" width="400px" height="100px"></img>
<p>
There are two types of search options in EpiCandIn.<br><br>

<b>a.</b> i. A simple search option is available on the top right corner of the header on all the pages.<br><br>
	
It allows users to query the whole database based on keywords. The number of hits, from each section of the database along with section name, is listed as a result. The results are hyperlinked to the detailed search result of the respective section.
<br><br>
Note: Only the first keyword will be considered for search if multiple keywords are given separated by space. Any other delimiter is invalid.
</p>
<img src="images/search_result1.JPG" width="400px" height="200px"></img>&nbsp;&nbsp;&nbsp;&nbsp; <img src="images/search_result2.JPG" width="600px" height="200px"></img>
<br>
<br>
<p>
<b>b.</b> ii. The Search option on the navigation bar allows users to query the whole database section-wise using specific keywords and by selecting fields and applying logical operators (AND, OR).
</p>
<img src="images/adv_search.JPG" width="700px" height="300px"></img>
<p>
To build a query, one field (explained below) at a time should be selected and a keyword corresponding to the same should be typed in the blank space. Click on the  button to add the term to the query box. Use the logical operators and parentheses to build up a query.<br><br>
	
<b>Note:</b> Queries can be built combining options 'AND', 'OR' from one section at a time
</p>
<img src="images/advS_result.JPG" width="700px" height="200px"></img>

<h3>3. Browse</h3>
<p>
Browse page has sidebar filter through which user can select the columns. Selected columns are shown on the right of sidebar. Further, table can be filtered using search bar just above the table.
</p>
<img src="images/browse.JPG" width="700px" height="300px"></img>

<h3>4. Summary</h3>
<p>
Summary page shows four navigation tabs. Each tab contains bar graphs of overall number of publications.<br><br>
4. a) Publications
</p>
<img src="images/pub.JPG" width="700px" height="300px"></img>
<p>
4. b) Species
</p>
In this tab graph can be sorted decade wise using the list filter on right side and number of publications for particular species can be seen for each decade.
<img src="images/sps.JPG" width="700px" height="300px"></img>
<p>
4. c) Niche
</p>
In this tab graph can be sorted decade wise using the list filter on right side and number of publications for particular niche can be seen for each decade.
<img src="images/nic.JPG" width="700px" height="300px"></img>
<p>
4. d) Drugs
</p>
<img src="images/drg.JPG" width="700px" height="300px"></img>
<h3>5. Submit</h3>
<p>
User can submit their data using the given form on this page.
</p>
<img src="images/submit.png" width="600px" height="600px"></img>
<br>
<br>
<br>
<h4>Rules for redundancy removal</h4>
<?php
include("supp_1.php");	
?>

<br>
<h4>Different spellings used for the same species names</h4>
<?php
include("supp_3.php");	
?>
<br>


<br>
<h4>Type of candidiasis based on affected organs/niches</h4>
<?php
include("supp_2.php");	
?>



</main>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php
   
	include("footer.php");
?>
</body>
</html>