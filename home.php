<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$search = "";
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM trusts 
              WHERE status_checked = 0 AND (
                    trust_no LIKE '%$search%' OR
                    trust_name LIKE '%$search%' OR
                    registered_mobile LIKE '%$search%' OR
                    village LIKE '%$search%' OR
                    ward_no LIKE '%$search%'
              )
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM trusts WHERE status_checked = 0 ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);



?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Home | Waqf Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/home_style.css">
</head>
<body>

<div class="topbar">
    WAQF DATA DASHBOARD
    <a href="logout.php"><button class="btn logout">Logout</button></a>
</div>

<div class="container">
   <div class="actions">
        <a href="checked.php"><button class="btn">Checked Data</button></a>
        <a href="insert.php"><button class="btn">Insert Trust Record</button></a>
        <a href="export_excel.php"><button class="btn">Export Excel</button></a>
        <a href="export_pdf.php"><button class="btn">Export PDF</button></a>
   </div>

    <form method="GET" style="margin: 20px 0;">
    <input type="text" name="search"
        placeholder="Search by Trust No / Trust Name / Mobile / Area"
        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
        style="padding: 12px; width: 65%; border: 1.5px solid #ccc; border-radius: 8px; font-size:15px;">
    <button class="btn" style="padding: 12px 16px;">Search</button>
    <?php if(isset($_GET['search']) && $_GET['search'] != "") { ?>
        <a href="home.php"><button type="button" class="btn" style="background:#6b7280;">Reset</button></a>
    <?php } ?>
</form>


    <table>
        <tr>
            <th>Trust No</th>
            <th>Trust Name</th>
            <th>Registered Mobile</th>
            <th>Area</th>
            <th>Mark Checked</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                if ($row['area_type'] == "Rural") {
                    $area_display = "Rural – " . $row['village'];
                } elseif ($row['area_type'] == "Urban") {
                    $area_display = "Urban – " . $row['ward_no'] . " (" . $row['municipal'] . ")";
                } else {
                    $area_display = "-";
                }
        ?>
            <tr>
                <td><?php echo $row['trust_no']; ?></td>
                <td><?php echo $row['trust_name']; ?></td>
                <td><?php echo $row['registered_mobile']; ?></td>
                <td><?php echo $area_display; ?></td>
                <td>
                    <!-- When checked, move to Checked list -->
                    <form method="POST" action="update_status.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="status" value="1"> <!-- 1 = Checked -->
                        <input type="checkbox" class="chk" onchange="this.form.submit()">
                    </form>
                </td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5' class='no-data'>No Unchecked Trust Records Found</td></tr>";
        }
        ?>
    </table>
</div>

<?php include "footer.php"; ?>


</body>
</html>
