<?php
session_start();
function fetch_data(){  
      $output = '';  
 /*include("../../connect.php"); 
$sqlPrint = "SELECT * from steps_first_sem p inner join steps_student_master q on p.first_stud_id = q.stud_id and p.semester_session = '".$_POST['semester_session']."' and p.first_sub_id = '".$_POST['sem_sub_id']."' and p.semester_id =  '".$_POST['semester_list']."' group by p.first_stud_id
" ;
 
$stmt = $conn->prepare($sqlPrint);
$stmt->execute();
$resultPrint = $stmt->get_result();
while($rowPrint = $resultPrint->fetch_assoc()){*/
      $output .= '
			<div class="invoice-bill row">
				<div class="col-sm-12 text-xs-center">
					<address>
			The following is the statement of marks and grades obtained by:&nbsp;fffffffff fffffffff&nbsp; Enrollment No.: ffff&nbsp; Roll NO.: 55 &nbsp; Registration No.: 345345 of 234523455 M.Sc. 1<sup>st</sup></b>&nbsp; Semester Examination 2022
						
				   </address>
				</div>
			</div>
					        <div class="row">
					            <div class="col-lg-12 table-responsive">
					                
                                    <table style="font-size:8.5px;" border="1" align="center">
								 <tr style="font-size:10px;">
									<th rowspan="2">COURSE NO.</th>
									<th rowspan="2">Group/Unit</th>
									<th rowspan="2">COURSE TITLE     </th>
									<th rowspan="2">FULL MARKS</th>
									<th colspan="3">MARKS OBTAINED</th>
									<th rowspan="2">LETTER GRADE</th>
									<th rowspan="2">GRADE POINT</th>
									<th rowspan="2">CREDIT</th>
									<th rowspan="2">CREDIT POINTS</th>
						
								</tr>  
        <tr>

            <th >INTERNAL ASSESSMENT(05/10)</th>
            <th>END SEMESTER EXAMINATION(20/10/10)</th>
            <th>TOTAL</th>


        </tr> 

        <tr>
            <td rowspan="2">NUD 101</td>
            <td rowspan="2">1<BR>2</td>
            <th>THEORY PAPERS</th>
            <td rowspan="2">25 <BR> 25</td>
            <td rowspan="2">4 <BR>4</td>
            <td rowspan="2">13 <BR> 14</td>
            <td rowspan="2">35</td>
            <td rowspan="2">A</td>
            <td rowspan="2">8</td>
            <td rowspan="2">4</td>
            <td rowspan="2">32</td>
        </tr>
        <tr>

            <td>
                PHYSIOLOGICAL ASPECTS OF NUTRITION I<br> 
                PHYSIOLOGICAL ASPECTS OF NUTRITION II 
            </td>

        </tr>

        <tr>
            <td>NUD 102</td>
            <td>3<BR>4</td>
            <td>
                BIOPHYSICAL ASPECTS OF NUTRITION<BR>
                BIOPHYSICAL ASPECTS OF NUTRITION

            </td>
            <td>25 <BR> 25</td>
            <td>4 <BR>4</td>
            <td>13 <BR> 14</td>
            <td>35</td>
            <td>A</td>
            <td>8</td>
            <td>4</td>
            <td>32</td>
        </tr>
        <tr>
            <td>NUD 103</td>
            <td>5<BR>6</td>
            <td>
                METABOLISM OF MACRO NUTRIENTS AND ITS MOLECULAR BASIS<BR> 
                MICRONUTRIENTS IN NUTRITION

            </td>
            <td>25 <BR> 25</td>
            <td>4 <BR>4</td>
            <td>13 <BR> 14</td>
            <td>35</td>
            <td>A</td>
            <td>8</td>
            <td>4</td>
            <td>32</td>
        </tr>
        <tr>
            <td>NUD 104</td>
            <td>7<BR>8</td>
            <td>
                FOOD HYGIENE AND SANITATION<BR>
                FOOD TOXICOLOGY AND FOOD SAFETY

            </td>
            <td>25<BR> 25</td>
            <td>4 <BR>4</td>
            <td>13<BR> 14</td>
            <td>35</td>
            <td>A</td>
            <td>8</td>
            <td>4</td>
            <td>32</td>
        </tr>


        <tr>
            <td></td>
            <td></td>
            <th>
                TOTAL OF THEORY PAPERS  
            </th>
            <th>200</th>
            <td colspan="2"></td>
            <th>150</th>
            <td></td>
            <td></td>
            <th>16</th>
            <th>132</th>

        </tr>
        <tr>
            <td rowspan="2">NUD 101</td>
            <td rowspan="2">1<BR>2</td>
            <th>PRACTICAL PAPERS</th>
            <td rowspan="2">25 <BR> 25</td>
            <td rowspan="2">4 <BR>4</td>
            <td rowspan="2">13 <BR> 14</td>
            <td rowspan="2">35</td>
            <td rowspan="2">A</td>
            <td rowspan="2">8</td>
            <td rowspan="2">4</td>
            <td rowspan="2">32</td>
        </tr>
        <tr>

            <td>
                EXPERIMENTS ON NUTRITIONAL BIOCHEMISTRY-I<BR>
                EXPERIMENTS ON NUTRITIONAL BIOCHEMISTRY-II

            </td>

        </tr>

        <tr>
            <td>NUD 196</td>
            <td>11<BR>12</td>
            <td>
                EXPERIMENTS ON PHYSIOLOGY<BR> 
                NUTRITIONAL ANTHROPOMETRY

            </td>
            <td>25 <BR> 25</td>
            <td></td>
            <td>12 <BR> 15</td>
            <td>35</td>
            <td>A</td>
            <td>8</td>
            <td>4</td>
            <td>32</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <th>
                TOTAL OF PRACTICAL PAPERS 

            </th>
            <th>100</th>
            <td colspan="2"></td>
            <th>59</th>
            <td></td>
            <td></td>
            <th>8</th>
            <th>52</th>

        </tr>
        <tr>
            <th colspan="3">TOTAL</th>
            <th>300</th>
            <td></td>
            <td></td>
            <th>209</th>
            <td></td>
            <td></td>
            <th>24</th>
            <th>184</th>
        </tr>
        <tr>
            <th colspan="2">SGPA OF 1<SUP>st</SUP> SEMESTER</th>
            <th>TOAL PERCENTAGE(%) OF MARKS</th>
            <th colspan="3">RESULT</th>
            <th colspan="5">REMARKS</th>

        </tr>
        <tr>
            <td colspan="2">7.67</td>
            <td>69.67</td>
            <td colspan="3">SQ</td>
            <td colspan="5">ABABAUUKEUKHDEKUDHEKUDFGHKEDFKQW</td>

        </tr>
    </table>  
					            </div>
                                
                                
					        </div>
					
					        <div class="clearfix">
					            

                          ';  
/*}*/
return $output; 
      }  
       
 
 if(isset($_POST["btnCreatePDF"]))  
 { 
      require_once('../../webMaster/assets/TCPDF/tcpdf.php'); 
	 $custom_layout = array(215.9, 330.2);
     $pdf = new TCPDF('P', PDF_UNIT, $custom_layout, true, 'UTF-8', false);  
	 

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      $pdf->SetFont('helvetica', '', 8);  
	  $pdf->SetMargins(2, 20, 2, true);
      $pdf->AddPage();  
      $content = '';  
      $content .= '';  
      $content .= fetch_data();  
      $pdf->writeHTML($content);  
      $pdf->Output('Result.pdf', 'I');  
 }  
 ?>  