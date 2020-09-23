<?php
    require_once 'includes/initialize.php';

        $sql = base64_decode(filter_input(INPUT_GET ,"q"));
      	$records = Record::find_by_sql($sql);
	$data  = "";

	$data .= "  <table>
                            <thead>
                                <tr>
                                    <th rowspan='2'> CERTIFICATE NO:</th>
                                    <th rowspan='2'> PROPRIETOR</th>
                                    <th rowspan='2'> AMT. PAID</th>
                                    <th rowspan='2'>ISSUE DATE</th>
                                    <th rowspan='2'> LODGEMENT DATE</th>
                                    <th rowspan='2'> LODGEMENT NO.</th>
                                    <th rowspan='2'> PARCEL NO.</th>
                                    <th rowspan='2'> SECTION</th>
                                    <th rowspan='2'> PLAN NO.</th>
                                    <th colspan='2'> REGISTER</th>
                                    <th rowspan='2'> REMARKS</th>
                                </tr>
                                <tr>
                                    <th>VOLUME</th>
                                    <th>FOLIO</th>                                    
                                </tr>
                            </thead>
                            <tbody> ";
                                    foreach ($records as $record): 
	                          $data .="<tr>
                                    <td><b>". strtoupper($record->cno) . "</b></td>
                                    <td>".  strtoupper($record->prop) ."</td> 
                                    <td>". number_format($record->amtpaid,2, ".",'') ."</td>
                                    <td>".  datetime_to_text2($record->doi) ."</td>
                                    <td>". datetime_to_text2($record->dol) ."</td>
                                    <td>". strtoupper($record->lno)  ."</td>
                                    <td>"; if ($record->pno != ""){ $data .= strtoupper($record->pno); } else { $data .= "--------";}  $data .="</td>
                                    <td>"; if($record->section != 0){  $section = Section::find_by_id($record->section); $data .= $section->no . " - ". $section->name; }else { $data .= "--------";}  $data .="</td>
                                    <td>{$record->plno}</td>
                                    <td>{$record->volume}</td>
                                    <td>{$record->folio}</td>
                                    <td>{$record->remarks}</td>
                                </tr>";
			 endforeach;
                        $data .="    </tbody>
                        </table>     ";
	
	$filename ='RECORDS_VIEW_AS_AT-'.date('d_M_Y').'.xls';
         $lines = str_getcsv($data);
         $f = fopen($filename,'w+' );
         fputcsv($f, $lines);
         //fputcsv($f, str_getcsv($html));
         $out = $data;
        header("Content-Disposition: attachment; filename=".$filename);
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($filename));
        header("Pragma: no-cache");
        header("Expires: 0");
         readfile("./".$filename);
         unlink($filename);


