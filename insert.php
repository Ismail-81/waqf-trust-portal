<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$success = "";
$error = "";

if (isset($_POST['save'])) {
    $trust_no = mysqli_real_escape_string($conn, $_POST['trust_no']);
    $trust_name = mysqli_real_escape_string($conn, $_POST['trust_name']);
    $registered_mobile = mysqli_real_escape_string($conn, $_POST['registered_mobile']);
    $area_type = mysqli_real_escape_string($conn, $_POST['area_type']);

    // Rural / Urban values
    $village = mysqli_real_escape_string($conn, $_POST['village']);
    $municipal = mysqli_real_escape_string($conn, $_POST['municipal']);
    $ward_no = mysqli_real_escape_string($conn, $_POST['ward_no']);

    if ($registered_mobile == "") {
        $error = "Registered Mobile Number is required.";
    } else {
        $query = "INSERT INTO trusts (trust_no, trust_name, registered_mobile, area_type, village, municipal, ward_no) 
                  VALUES ('$trust_no', '$trust_name', '$registered_mobile', '$area_type', '$village', '$municipal', '$ward_no')";
        mysqli_query($conn, $query);
        $success = "Record Inserted Successfully!";
        header("refresh: 1; url=home.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Insert Trust | Waqf Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/insert_style.css">
    <style>
        /* fix for hidden class & fade animation */
        .hidden { display: none; }
        .fade { animation: fadeIn .25s ease; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Insert Trust Record</h2>
    <p class="subtitle">Add a new trust entry to the database</p>

    <?php if ($success) echo "<div class='msg-success'>$success</div>"; ?>
    <?php if ($error) echo "<div class='msg-error'>$error</div>"; ?>

    <form method="POST">

        <!-- AREA TYPE -->
        <div class="input-group">
            <label>Area Type</label><br>
            <label class="radio-label"><input type="radio" name="area_type" class="rdio" value="Rural" onclick="toggleFields()" required> Rural</label>
            <label class="radio-label"><input type="radio" name="area_type" class="rdio" value="Urban" onclick="toggleFields()"> Urban</label>
        </div>

        <!-- RURAL: BHARUCH VILLAGES -->
        <div class="input-group hidden" id="rural_field">
            <label>Select Village</label>
            <select name="village" style="
                width:100%;
                padding:13px 16px;
                border:1.5px solid #e5e7eb;
                border-radius:10px;
                font-size:15px;
                background:#f9fafb;
                color:#111827;
                font-family:'Inter',sans-serif;
                appearance:none;
                -webkit-appearance:none;
                -moz-appearance:none;
                background-image:url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' viewBox=\'0 0 12 12\'%3E%3Cpath fill=\'%236b7280\' d=\'M6 9L1 4h10z\'/%3E%3C/svg%3E');
                background-repeat:no-repeat;
                background-position:right 16px center;
                padding-right:40px;
            ">

                <option value="">-- Select Village --</option>
                <?php
                $villages = [
                    "Adol","Amdada","Amleshwar","Angareshwar","Asuria","Bambusar","Bhadbhut","Bharthana",
                    "Bholav","Bhuva","Borbhatha Bet","Bori","Chavaj","Cholad","Dabhali","Dahegam","Dashan",
                    "Dayadra","Derol","Detral","Eksal","Ghodi","Haldar","Haldarwa","Hingalla","Hinglot",
                    "Jhadeshwar","Jhanghar","Jhanor","Kahan","Kamboli","Kanthariya","Karela","Kargat",
                    "Karjan","Karmad","Karmali","Kasad","Kasva","Kavitha","Kelod","Kesrol","Kishnad",
                    "Kothi","Kukarwada","Kurala","Kuvadar","Luwara","Mahegam","Mahudhala","Maktampur",
                    "Manad","Manch","Mangleshwar","Manubar","Nabipur","Nand","Nandelav","Navetha","Nikora",
                    "Osara","Padariya","Paguthan","Palej","Pariej","Parkhet","Pipalia","Rahadpor","Samlod",
                    "Sankhvad","Sarnar","Segva","Shahpura","Sherpura","Shuklatirth","Simalia","Sindhot",
                    "Sitpon","Tankariya","Tavara","Tham","Thikaria","Tralsa","Tralsi","Umara","Umraj",
                    "Uparali","Vadadla","Vadva","Vagusana","Vahalu","Vansi","Varedia","Verwada","Vesdada"
                ];
                foreach ($villages as $v) echo "<option value='$v'>$v</option>";
                ?>
            </select>
        </div>

        <!-- URBAN -->
        <div id="urban_fields" class="hidden">
            <div class="input-group fade">
                <label>Municipal Corporation</label>
                <input type="text" name="municipal" value="Bharuch Nagar Palika" class="txtbox" readonly>
            </div>

            <div class="input-group fade">
                <label>Ward Number</label>
                <select name="ward_no" style="
                    width:100%;
                    padding:13px 16px;
                    border:1.5px solid #e5e7eb;
                    border-radius:10px;
                    font-size:15px;
                    background:#f9fafb;
                    color:#111827;
                    font-family:'Inter',sans-serif;
                    appearance:none;
                    -webkit-appearance:none;
                    -moz-appearance:none;
                    background-image:url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' viewBox=\'0 0 12 12\'%3E%3Cpath fill=\'%236b7280\' d=\'M6 9L1 4h10z\'/%3E%3C/svg%3E');
                    background-repeat:no-repeat;
                    background-position:right 16px center;
                    padding-right:40px;
                ">

                    <option value="">-- Select Ward --</option>
                    <?php for ($i = 1; $i <= 12; $i++) echo "<option value='Ward $i'>Ward $i</option>"; ?>
                </select>
            </div>
        </div>

        <div class="input-group">
            <label>Trust No</label>
            <input type="text" name="trust_no" class="txtbox" placeholder="Enter Trust No (Optional)">
        </div>

        <div class="input-group">
            <label>Trust Name</label>
            <input type="text" name="trust_name" class="txtbox" placeholder="Enter Trust Name">
        </div>

        <div class="input-group">
            <label>Registered Mobile Number <span style="color:#ef4444;">*</span></label>
            <input type="text" name="registered_mobile" class="txtbox" placeholder="Enter Mobile Number" required>
        </div>

        <button type="submit" name="save">Save Record</button>
    </form>

    <a class="back" href="home.php">Back to Home</a>
</div>

<script>
function toggleFields() {
    let rural = document.querySelector("input[value='Rural']").checked;
    let urban = document.querySelector("input[value='Urban']").checked;

    document.getElementById("rural_field").classList.toggle("hidden", !rural);
    document.getElementById("urban_fields").classList.toggle("hidden", !urban);
}
</script>
<?php include "footer.php"; ?>

</body>
</html>
