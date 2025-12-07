<?php
require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;

include "config.php";

$html = '
<h2 style="text-align:center; margin-bottom:10px;">WAQF TRUST DATA REPORT</h2>
<p style="text-align:center; font-size:14px; margin-bottom:18px;">Generated on: '.date("d-m-Y H:i A").'</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
<tr style="background:#157532; color:white; font-weight:bold;">
<th>Trust No</th>
<th>Trust Name</th>
<th>Mobile</th>
<th>Area</th>
<th>Status</th>
</tr>';

$query = mysqli_query($conn, "SELECT * FROM trusts ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($query)) {

    // Area formatting for PDF
    if ($row['area_type'] == "Rural") {
        $area_display = "Rural – " . $row['village'];
    } elseif ($row['area_type'] == "Urban") {
        $area_display = "Urban – " . $row['ward_no'] . " (" . $row['municipal'] . ")";
    } else {
        $area_display = "-";
    }

    $status = $row['status_checked'] == 1 ? "Checked" : "Not Checked";

    $html .= "<tr>
        <td>{$row['trust_no']}</td>
        <td>{$row['trust_name']}</td>
        <td>{$row['registered_mobile']}</td>
        <td>{$area_display}</td>
        <td>{$status}</td>
    </tr>";
}

$html .= "</table>
<br><br>
<p style='text-align:center; font-size:12px; color:#444;'>Waqf Trust Data System Report • © " . date("Y") . "</p>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream("waqf_trust_data.pdf", ["Attachment" => true]);
?>
