<?php
include "config.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=waqf_trust_data.xls");

$output = fopen("php://output", "w");

// Column headers
fputcsv($output, ["Trust No", "Trust Name", "Registered Mobile", "Area", "Status"], "\t");

$query = mysqli_query($conn, "SELECT * FROM trusts ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($query)) {

    // Area formatting
    if ($row['area_type'] == "Rural") {
        $area_display = "Rural – " . $row['village'];
    } elseif ($row['area_type'] == "Urban") {
        $area_display = "Urban – " . $row['ward_no'] . " (" . $row['municipal'] . ")";
    } else {
        $area_display = "-";
    }

    $status = $row['status_checked'] == 1 ? "Checked" : "Not Checked";

    fputcsv(
        $output,
        [$row['trust_no'], $row['trust_name'], $row['registered_mobile'], $area_display, $status],
        "\t"
    );
}

fclose($output);
exit;
?>
