<?php
error_reporting(E_ALL);
include("connect.php");  
include('header.php');   
session_start();
 
$dataset ="disease";
  $p_value1 = $_POST["p_value1"];
  
  $p_value2 = $_POST["p_value2"];
  $p_valuee = $p_value1*pow(10, -$p_value2);
  //echo $p_valuee;
    $i=0;
    $disha=array();
    // If Disease Selected
       $col1=array();
        foreach($_POST["dis_grr"] as $disa) {
            $disb=str_replace("'", "\'", $disa);
            $disha[]=$disa;
			//echo "Session working";
        
    }
	
	$qry = "select snps, study_accession, pubmedid, context, p_value, snp_type, chr, pos, casee, control, gene, review FROM snp_table where";
	if(isset($_POST['revFil'])){
	
    foreach($_POST['revFil'] as $cla ){
	
	if($cla == "all"){
		
	$qry = "select snps, study_accession, pubmedid, context, p_value, snp_type, chr, pos, casee, control, gene, review FROM snp_table where"; 	
	}
	else
	if($cla == 'Coding' or $cla == 'Non-coding')
	{
		$qry = $qry." snp_type = '$cla' AND";
	}
	else{
			$qry = $qry." review = '$cla' AND";
		}
	
		
}
	
	}
	else{
		$qry = "select snps, study_accession, pubmedid, context, p_value, snp_type, chr, pos, casee, control, gene, review FROM snp_table where";
	}
	
	$_SESSION["revFil"] = $qry;
	
	
		
                 /// Don't move from here   
  if(count($disha) > 0)
	{  ?>
    <script>
    function showLoading() {
        document.getElementById('loadingmsg').style.display = 'block';
        document.getElementById('loadingover').style.display = 'block';
    }
</script>


<script type="text/javascript">
function validate()
{
	  var hid = $('input[type="hidden"][name="stu_acc[]"]').serializeArray();
          var fields = $("input[name='stu_acc[]']").serializeArray();
          if (fields.length == 0 && hid.length == 0 )
         {
               alert('Please select entriese');
			   var success = false;
         }else
        {
		 
		  if($('#c_snp').is(':checked') || $('#nc_snp').is(':checked') || $('#c_snp_map').is(':checked')){
                if($('#select_TissID').val() != ''){
                    showLoading();
					return true;
					
                }else{
                    alert('Select tissue');
                    return false;
                }
            }else{
                alert('Select the Type of SNP');
                return false;
            }
         
             showLoading();
        }
	   return success;
}
</script>
<script src="js/select2_min.js"></script>
<link rel="stylesheet" href="css/select2_min.css">

<style type="text/css">
    #loadingmsg {
        color: black;
        background: #fff;
        padding: 10px;
        position: fixed;
        top: 50%;
        left: 46%;
        z-index: 100;
        margin-right: -25%;
        margin-bottom: -25%;
    }

    #loadingover {
        background: black;
        z-index: 99;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
        filter: alpha(opacity=80);
        -moz-opacity: 0.8;
        -khtml-opacity: 0.8;
        opacity: 0.8;
    }

    #sec_rem, #sec{
        width: 500px;
        overflow: auto;
    }

    .showBorder{
        border: 1px solid black;
    }

    .analType{
        padding: 7px;
        border-radius: 4px;
    }

    .allBtn{
        border-radius: 4px;
        padding: 6px 10px;
    }

    .select2-container .select2-search--inline .select2-search__field{
        margin-top: 7px;
        margin-left: 8px;
    }

    /* .select2-container--default .select2-results>.select2-results__options {
        max-height: 258px;
    } */
    
	 select.form-control{
    display: inline;
    width: 150px;
    margin-left: 25px;
	margin-right: 10px;
	padding: 3px;
	
  }
	thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
		display: table-header-group;
    }
	

</style>

   

      <div style="padding:15px;">
   
     
  <form action="qtAnal.php" method="post" name="myForm" id="myForm">
  

<h2 align="center">Disease analyzer</h2>

<!-- Create the drop down filter
    <div class="category-filter">
    

      <select id="categoryFilter" class="form-control">
        <option value="">Show All</option>
        
      </select>
    </div> -->





<div id="dwnld" align="right" style="float: right; margin-right: 0px;"></div>
<table width="100%" border="1" cellspacing="0" cellpadding="4" id="qtlTblMap" align="center" bordercolor="#B99C6B">

<thead bgcolor="#F1E8D1">
<tr>

<th class="th-sm">Diseases/Traits/Phenotype</th>
<th class="th-sm">Study accessions</th>
<th class="th-sm">PubMed ID</th>
<th class="th-sm">Case</th>
<th class="th-sm">Control</th>
<th class="th-sm">Review</th>
<th class="th-sm">SNP ID</th>
<th class="th-sm">SNP type</th>
<th class="th-sm">Location</th>
<th class="th-sm">Mapped gene/s</th>
<th class="th-sm">P-value</th>

</tr>
</thead>

<tbody>
<?php
 
 echo $qry;
 
for($i=0; $i<sizeof($disha); $i++){
$disn = preg_replace("/'/", '`', $disha[$i]);	                

                $res4 = mysqli_query($conn, $qry." disease_merge = '$disn' and p_value < '$p_valuee' ORDER BY study_accession");
               
				$cntds=mysqli_num_rows($res4);
				
               while ($row4 = mysqli_fetch_array($res4)) 
				{
					$hypStu_Acc=$row4["study_accession"];
                    $qsnps = $row4['snps'];
                    $stu_Acc[$cni] = $row4['study_accession'];
                    if($row4['snp_type'] != ''){
                        $qcntxt = $row4['snp_type'];
                    }else{
                        $qcntxt = "-";
                    }
                    $qchr_id = $row4['chr'];
                    $qchr_pos = $row4['pos'];
                    
                    $qmad_gen = $row4['gene'];
					?>
                    <tr>
                    
                    <td><?php echo $disn; ?></td>
                    
				
                    <td><?php echo "<a href='https://www.ebi.ac.uk/gwas/studies/$hypStu_Acc' target=_blank>$hypStu_Acc</a>"; ?></td>
                    <td><?php echo $row4['pubmedid']; ?></td>
                    <td><?php echo $row4['casee']; ?></td>
                    <td><?php echo $row4['control']; ?></td>
                    <td><?php echo $row4['review']; ?></td>
                    
					
               <td><?php echo $qsnps; ?></td>
                    <td><?php echo $qcntxt; ?></td>
                    <td><?php echo "$qchr_id: $qchr_pos"; ?></td>
                    <td><?php echo $qmad_gen; ?></td>
                    <td><?php $pval ="";
					$pval = sprintf("%.2e", $row4['p_value']);
					echo $pval; ?></td>
					
					
					</tr>
               <?php
				}
}
	
	
				?>			   

               
</tbody>



</table>

<br>
<p><b>Select SNPs for downstream analysis</b></p>
<div>
<form method="post" action="" name="getval">
<input type="checkbox" name="revFil[]" value="all" onChange="this.form.submit()" checked>
<label for="html">All</label>&nbsp;&nbsp;

<input type="checkbox" name="revFil[]" value="Reviewed" onChange="this.form.submit()"><!-- column 5 in table  --->
<label for="html">Reviewed</label>&nbsp;&nbsp;

<input type="checkbox" name="revFil[]" value="Non-reviewed" onChange="this.form.submit()"><!-- column 5 in table  --->
<label for="html">Non-reviewed</label>&nbsp;&nbsp;


<input type="checkbox" name="revFil[]" value="Coding" onChange="this.form.submit()"> <!-- column 7 in table  --->
<label for="html">Coding</label>&nbsp;&nbsp;

<input type="checkbox" name="revFil[]" value="Non-coding" onChange="this.form.submit()"><!-- column 7 in table  --->
<label for="html">Non-coding</label>&nbsp;&nbsp;
</div>
</form>
<br>
<br>
  <script>
  //var rowCnt = <?php echo json_encode($cntds);  ?>;
  var rowCnt = 10;
  
		 
  
		var table = new DataTable('#qtlTblMap', {
			"pageLength": 25,
			
    initComplete: function () {
        // Dropdowns for columns 0, 5, 7
        this.api()
            .columns([0, 5, 7])
            .every(function () {
                let column = this;
 
                // Create select element
                let select = document.createElement('select');
                select.add(new Option('All'));
                column.header().append(select);
 
                // Apply listener for user change in value
                select.addEventListener('change', function () {
                    var val = DataTable.util.escapeRegex(select.value);
 
                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
 
                // Add list of options
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        select.add(new Option(d));
                    });
            });

        // Text input boxes for columns 1, 2, 3, 4, 6, 8
        this.api()
            .columns([1, 2, 3, 4, 6, 8, 9])
            .every(function () {
                let column = this;
                let title = column.header().textContent;
 
                // Create input element
                let input = document.createElement('input');
                input.placeholder = title;
                column.header().append(input);
 
                // Event listener for user input
                input.addEventListener('keyup', () => {
                    if (column.search() !== input.value) {
                        column.search(input.value).draw();
                    }
                });
            });
			
		/* // review filter
			// Add event listener to radio buttons
			this.api()
            .columns([5])
            .every(function () {
				let column = this;
            $('input[name="revFil"]').change(function () {
                var filterValue = $(this).val();
				console.log(filterValue);
				if(filterValue != 'all'){
                // Apply filter to the "review" column (adjust column index as needed)
                column.search(filterValue).draw();
				}
				
            });
		}); */
		
		// Add event listener to Review radio buttons
            /* $('input[name="revFil"]').change(function () {
                var filterValue = $(this).val();
                console.log(filterValue);  // Check if filterValue is correctly captured in the console
				
                // Apply filter to the "review" column (adjust column index as needed)
				if(filterValue != 'all'){
					if(filterValue == 'Coding' || filterValue == 'Non-coding')
				{
					index = 7;
				}
				else{
					index = 5;
				}
                table.column(index).search('^' + filterValue + '$', true, false).draw();
				}
				else{
					table.search('').columns().search('').draw();
				}
            }); */
			
			/* // Add event listener to Coding radio buttons
            $('input[name="codFil"]').change(function () {
                var filterValue = $(this).val();
                console.log(filterValue);  // Check if filterValue is correctly captured in the console
				
                // Apply filter to the "review" column (adjust column index as needed)
				if(filterValue != 'all'){
                table.column(7).search('^' + filterValue + '$', true, false).draw();
				}
				else{
					table.column(7).search('').draw();
				}
            }); */
			
/* // Event listener for checkbox changes
$('input[name="revFil[]"]').on('change', function () {
     

    
    $('input[name="revFil[]"]:checked').each(function () {
        var filterValue = $(this).val();
		//console.log(filterValue);
       
		
		if(filterValue != 'all'){
					if(filterValue == 'Coding' || filterValue == 'Non-coding')
				{
					index = 7;
				}
				else{
					index = 5;
				}
                table.column(index).search('^' + filterValue + '$', true, false);
				}
				else{
					table.search('').columns().search('').draw();
				}
	
    });
table.draw();
    
}); 
			 */
	
	}
			
	 
	
});



			
// Handle form submission event
   $('#myForm').on('submit', function(e){
	   $('#myForm').find('input[name="stu_acc[]"]:hidden').remove();
      var form = this;
	  
	  
     // var rows_selected = table.column(11).checkboxes.selected(); // index of checkbox column
	 
	 var rows_selected = table.rows.data();
	 
	 var uniqueStudyValues = [...new Set(filteredData.column('study').data())];
	  

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
		  rowdata =  table.row(index).data();
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'stu_acc[]')
				.val(rowId+"#"+rowdata[0])
                
				
         );
		console.log(rowId+"#"+rowdata[0]);
		
      });
	  
	   return validate();
   });
		/* // Check the number of rows
        var rowCount = table.rows().count();
		console.log(rowCount);

        // Disable pagination if the number of rows is less than 20
       if (rowCount < 20) {
            table.paging = false;
            table.draw(); // Redraw the table to apply the changes
        } */
</script>         
         
      <table width="100%" border="0" align="center" cellpadding="6" cellspacing="0" style="margin-top: 10px;">
            <tr>
                <td width="30%">
                <label><strong>Mapping analysis:</strong></label>
                    <div style="padding-top: 10px; padding-left: 10px; line-height:6px;">
                        <div>
                            <input type="checkbox" name="cdngChkMap" id="c_snp_map" value="Coding">
                            <label>Coding SNPs</label>
                        </div>
                        </div>
                        
                        <br />
				
				<br>
                    <label><strong>QTL Analysis:</strong></label>
                    <div style="padding-top: 12px; padding-left: 10px;">
                        <div>
                            <input type="checkbox" name="cdngChk" id="c_snp" value="Coding">
                            <label>Coding SNPs</label>
                        </div>
                        &nbsp;
                        <div>
                            <input type="checkbox" name="ncdngChk" id="nc_snp" value="Non-coding">
                            <label>Non-coding SNPs</label>
                        </div>
                    </div>
                </td>
               
                <td valign="middle">
                <p>&nbsp;</p><br />
                <p>&nbsp;</p>
                    <div id="qtlSelect" class="sel_tiss">
                        <select class="select_TissCls" name="tissue[]" id="select_TissID" multiple="multiple" style="width:640px;" data-placeholder="Select Tissue">
                            <option></option>
                            <?php  
							$tab=array("Adipose", "Adipose-Subcutaneous", "Adipose-Visceral", "Adrenal_Gland", "Artery", "Artery-Aorta", "Artery-Coronary", "Artery-Tibial", "Bladder", "Blood", "Blood-B_cell", "Blood-B_cell_CD19+", "Blood-Erythroid", "Blood-Macrophage", "Blood-Monocyte", "Blood-Monocytes_CD14+", "Blood-Natural_killer_cell", "Blood-Neutrophils_CD16+", "Blood-T_cell", "Blood-T_cell_CD4+", "Blood-T_cell_CD4+_activated", "Blood-T_cell_CD4+_naive", "Blood-T_cell_CD8+", "Blood-T_cell_CD8+_activated", "Blood-T_cell_CD8+_naive", "Bone", "Brain", "Brain-Amygdala", "Brain-Anterior_Cingulate_Cortex", "Brain-Caudate", "Brain-Cerebellar_Hemisphere", "Brain-Cerebellum", "Brain-Cortex", "Brain-Frontal_Cortex", "Brain-Hippocampus", "Brain-Hypothalamus", "Brain-Nucleus_Accumbens", "Brain-Pons", "Brain-Prefrontal_Cortex", "Brain-Putamen", "Brain-Spinal_Cord", "Brain-Substantia_Nigra", "Brain-Temporal_Cortex", "Breast", "Cartilage", "Central_Nervous_System", "Cervix", "Dendritic_cells", "Epithelium", "Esophagus", "Eye", "Fibroblast", "Gallbladder", "Heart", "Heart-Atrial_Appendage", "Heart-Left_Ventricle", "Kidney", "Large_Intestine", "Large_Intestine-Colon", "Large_Intestine-Rectum", "Liver", "Lung", "Lymphocyte", "Minor_Salivary_Gland", "Mouth-Saliva", "Mouth-Sputum", "Muscle", "Muscle-Skeletal", "Muscle-Smooth", "Ovary", "Pancreas", "Peripheral_Nervous_System", "Placenta", "Prostate", "Skin", "Small_Intestine", "Small_Intestine-Duodenum", "Small_Intestine-Ileum", "Spleen", "Stomach", "Testis", "Thymus", "Thyroid_Gland", "Uterus", "Vagina");
							foreach($tab as $tabn)
							{
							$tabn1 = ucfirst(str_replace("_", " ", $tabn));
							
                          echo"<option value='$tabn'>$tabn1</option>";
                          } ?>

                        </select>
                        <input type="button" id="addAll" value="Add all" style="margin: 0px 5px;" class="allBtn">
                        <input type="button" id="resetAll" value="Clear all" class="allBtn">
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 12px;">
                <div align="left">  
                   <label>
                     <strong>P-value cutoff:</strong>
                   </label>
                      <input name="p_value1" type="text" id="p_valu1" value="5" size="1" maxlength="1"/> X 10<sup>-<input name="p_value2" type="text" id="p_valu2" value="2" size="3" maxlength="2"></sup></div>
                    <table width="48%" border="0" align="center" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>
                                <div align="center">
                                <input type="hidden" name="dataset" value="<?php echo $dataset; ?>" />
                                  <input type="hidden" name="sel_rs" id="sel_rs">
                                  <input type="submit" value="Submit"/>
                                  &nbsp;   &nbsp;   &nbsp;
                                  <input type="button" id="button2" onclick="location.href='gwas.php';"
                                        value="Back" />
                                </div>
                               
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
     
                  

   
        <div align="center">
        <div id='loadingmsg' style='display: none;'>
            <div align="center">Processing, please wait......</div>
        </div>
        <div id='loadingover' style='display: none;'></div>
        <p></p>
    </div>




    
</form>
 <?php  }
	else
	{
		header('Location:gwas.php');
	} ?> 
</div>
<script>
 $('#select_TissID').select2();
    $('#addAll').click(function () {
        $("#select_TissID > option:not(:first-child)").prop("selected", true);
        $("#select_TissID").trigger("change");
    });

    $('#resetAll').click(function () {
        $("#select_TissID").val(0).trigger('change.select2')
    });
	
    /* function getData() {
        if ($(".checkbox").is(":checked")) {
            var selctDis = $('.dslyTble input:checked').map(function () {
                return $(this).val();
            }).get().join([separator = '***']);
            $('#sel_rs').val(selctDis);

            if($('#c_snp').is(':checked') || $('#nc_snp').is(':checked') || $('#c_snp_map').is(':checked')){
                if($('#select_TissID').val() != ''){
                    showLoading();
					return true;
					
                }else{
                    alert('Select tissue');
                    return false;
                }
            }else{
                alert('Select the Type of SNP');
                return false;
            }
        } else {
            alert("Select studies before submit")
            return false;
        }
    } */

</script>

<?php
    include('footer.php');
?>
