<?php
include("mpdf.php");
$pdfSize = $_GET['pdfsize'];
$pdfLayout = $_GET['pdflayout'];
$mpdf=new mPDF('c', $pdfSize, $pdfLayout); 

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

$mpdf->defaultheaderfontsize = 10;	/* in pts */
$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

$mpdf->defaultfooterfontsize = 12;	/* in pts */
$mpdf->defaultfooterfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */


$mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}/{nb}|Gmap Locations');
$mpdf->SetFooter('{PAGENO}');	/* defines footer for Odd and Even Pages - placed at Outer margin */

$mpdf->SetFooter(array(
	'L' => '',
	'C' => '',
	'R' => array(
		'content' => 'Created @ {DATE j-m-Y H:m}',
		'font-family' => 'monospace',
		'font-style' => '',
		'font-size' => '10',
	),
	'line' => 1,		/* 1 to include line below header/above footer */
), 'E'	/* defines footer for Even Pages */
);


$commonNode = array_merge($locations1, $locations2, $locations3);
$commonNode = array_unique(array_filter($commonNode));
$strContent = '';
$strContent .= '<div class="pdf-main">';
$strContent .= '</div>';

$newName = date('Y-m-d');
if($enlargeSize[1] == '800x490') $mapImgClass1 = 'pdf-map-img-enlarge'; else $mapImgClass1 = 'pdf-map-img';
if($enlargeSize[2] == '800x490') $mapImgClass2 = 'pdf-map-img-enlarge'; else $mapImgClass2 = 'pdf-map-img';
if($enlargeSize[3] == '800x490') $mapImgClass3 = 'pdf-map-img-enlarge'; else $mapImgClass3 = 'pdf-map-img';

$stylesheet = file_get_contents(drupal_get_path('module', 'gmap_custom').'/mpdf/pdf-style.css');
$html = '<div class="pdf-main">';
if($locationsArr1) $html .= '<div class="'.$mapImgClass1.'"><img src="'.$outPath.'gmap-first.jpg" /></div>';
if($locationsArr2) $html .= '<div class="'.$mapImgClass2.'"><img src="'.$outPath.'gmap-second.jpg" /></div>';
if($locationsArr3) $html .= '<div class="'.$mapImgClass3.'"><img src="'.$outPath.'gmap-third.jpg" /></div>';
$html .= '<div class="clear"></div>';
$html .= '<div class="pdf-pointer">';
$i = 1;
foreach($commonNode as $poiId) { 
    $poi = node_load($poiId);
    $html .= '<div class="pdf-pointer-list">';
    $html .= '<div class="pdf-item">';
    $headtile = $headPositionNew[$i];
    if($headtile and $i == $headtile) $html .= '<div class="pdf-point-title"><b>'.$headTitleNew[$i].'</b></div>';
    $html .= '<div class="pdf-pointer-img"><img src="'.$themePath.'/img/markers/red'.($i).'.png" /></div>';
    $html .= '<div class="pdf-pointer-title"><span>'.$poi->title.'</span><br />'.$poi->field_street[0][value];
    $html .= '<br />'.$poi->field_city[0][value].', '.$poi->field_state[0][value].' '.$poi->field_zip[0][value].'<br>'.$poi->field_phone[0][value].'</div>';
    $html .= '</div>';
    $html .= '</div>';
    $i++;
}
$html .= '</div>';
$html .= '</div>';
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);

$mpdf->Output($savePath.$newName.'.pdf');
$fileName = $outPath.$newName.'.pdf';
@Header("Content-type: application/pdf");
@Header("Content-Disposition: attachment; filename=$newName.pdf");
@readfile("$fileName");

?>