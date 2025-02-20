<?php

session_start();
$role = $_SESSION['role'];

if ($role != 'admin') {
    echo '<script>alert("You are not authorized to access this page"); window.location.href="../login.php";</script>';
    exit();
}

include_once('../backend/connection.php');

$query1 = "SELECT uid, username, fname, lname, nic, gender, dob, address, phone, email, role FROM user WHERE role = 'cashier'";
$result = mysqli_query($conn, $query1);

$query2 = "SELECT uid, username, fname, lname, nic, gender, dob, address, phone, email, role FROM user WHERE role = 'manager'";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT uid, username, fname, lname, nic, gender, dob, address, phone, email, role FROM user WHERE role = 'security'";
$result3 = mysqli_query($conn, $query3);

$query4 = "SELECT uid, username, fname, lname, nic, gender, dob, address, phone, email, role FROM user WHERE role = 'admin'";
$result4 = mysqli_query($conn, $query4);

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>Admin | Staff</title>
        <link rel="icon" type="image/x-icon" href="../images/logos/favicon.ico">

        <!-- meta tags -->
        <meta name="title" content="Admin | Staff | Ceft Online">
        <meta name="description" content="Ceft Online platform enables your online financial needs">
        <meta name="author" content="Ceft Bank">
        <meta name="keywords" content="ceft, online banking, finance, bank"/>

        <meta property="og:type" content="website">
        <meta property="og:url" content="https://www.ceft.online/">
        <meta property="og:title" content="Admin | Staff | Ceft Online">
        <meta property="og:description" content="Ceft Online platform enables your online financial needs">
        <meta property="og:image" content="https://www.ceft.online/images/og.png">

        <meta property="twitter:card" content="Admin | Staff | Ceft Online">
        <meta property="twitter:url" content="https://www.ceft.online/">
        <meta property="twitter:title" content="Admin | Staff | Ceft Online">
        <meta property="twitter:description" content="Ceft Online platform enables your online financial needs">
        <meta property="twitter:image" content="https://www.ceft.online/images/og.png">

        <!-- styles -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- scripts -->
        <script src="../js/script.js"></script>

        <style>
            td {
                padding: 10px !important;
            }
        </style>

    </head>
    <body class="dashboard-body">

    <?php include './layouts/navbar.php' ?>
    <?php include './layouts/admin_secondary_nav.php' ?>

    <div id="detail-panel" style="display: none;" class="view-panel-container container-mid">
        <div class="view-panel">
            <p style="font-weight: bold;">Staff Member Details</p>
            <table style="text-align: left; border: 1px solid #ebe0ff; padding: 20px 40px; border-radius: 20px;">
                <tr>
                    <td>Name:</td>
                    <td><span id="panel-name"></span></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><span id="panel-username"></span></td>
                </tr>
                <tr>
                    <td>NIC:</td>
                    <td><span id="panel-nic"></span></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td><span id="panel-gender"></span></td>
                </tr>
                <tr>
                    <td>DOB:</td>
                    <td><span id="panel-dob"></span></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><span id="panel-address"></span></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><span id="panel-phone"></span></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><span id="panel-email"></span></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td><span id="panel-role"></span></td>
                </tr>

            </table>

            <button onclick="document.getElementById('detail-panel').style.display='none'" class="dark-bg-button"
                    style="margin-top: 30px; margin-bottom: 30px; width: 160px;">
                Close
            </button>
        </div>
    </div>

    <div class="dashboard-board" style="min-height: calc(100vh - 227px);">

        <div class="container breadcrumb">
            <a href="./staff.php">Staff</a>
        </div>

        <div class="dash-container container-mid">
            <div class="contact-form" id="dash1" style="width: 90%">

                <div class="">
                    <div class="login-main-side container-mid login-grid-1" style="overflow-x: auto;">
                        <h1 style="margin: 10px 0 30px;">Staff Members</h1>

                        <hr style="border: 1px solid #dcc9ff; width: 100%;">
                        <p style="font-weight: bold">Cashiers</p>
                        <table>
                            <?php
                            if (mysqli_num_rows($result) > 0) {

                                echo '<tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo
                                        '<tr>
                                    <td>' . $row['uid'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>
                                    <button class="table-btn" onclick=\'viewDetails("' . $row['uid'] . '", "' . $row['username'] . '", "' . $row['fname'] . ' ' . $row['lname'] . '", "' . $row['nic'] . '", "' . $row['gender'] . '", "' . $row['dob'] . '", "' . $row['address'] . '", "' . $row['phone'] . '", "' . $row['email'] . '", "' . $row['role'] . '")\'>
                                    View
                                    </button><button onclick=\'updateRedirect(' . $row['uid'] . ')\' class="table-btn">Update</button><button onclick=\'deleteRedirect(' . $row['uid'] . ')\' class="table-btn">Delete</button></td>
                                </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </table>
                        <br><br>

                        <hr style="border: 1px solid #dcc9ff; width: 100%;">
                        <p style="font-weight: bold">Managers</p>
                        <table>
                            <?php
                            if (mysqli_num_rows($result2) > 0) {

                                echo '<tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>';

                                while ($row = mysqli_fetch_assoc($result2)) {
                                    echo
                                        '<tr>
                                    <td>' . $row['uid'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>
                                    <button class="table-btn" onclick=\'viewDetails("' . $row['uid'] . '", "' . $row['username'] . '", "' . $row['fname'] . ' ' . $row['lname'] . '", "' . $row['nic'] . '", "' . $row['gender'] . '", "' . $row['dob'] . '", "' . $row['address'] . '", "' . $row['phone'] . '", "' . $row['email'] . '", "' . $row['role'] . '")\'>
                                    View
                                    </button><button onclick=\'updateRedirect(' . $row['uid'] . ')\' class="table-btn">Update</button><button onclick=\'deleteRedirect(' . $row['uid'] . ')\' class="table-btn">Delete</button></td>
                                </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </table>
                        <br><br>

                        <hr style="border: 1px solid #dcc9ff; width: 100%;">
                        <p style="font-weight: bold">Cyber Security Officers</p>
                        <table>
                            <?php
                            if (mysqli_num_rows($result3) > 0) {

                                echo '<tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>';

                                while ($row = mysqli_fetch_assoc($result3)) {
                                    echo
                                        '<tr>
                                    <td>' . $row['uid'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>
                                    <button class="table-btn" onclick=\'viewDetails("' . $row['uid'] . '", "' . $row['username'] . '", "' . $row['fname'] . ' ' . $row['lname'] . '", "' . $row['nic'] . '", "' . $row['gender'] . '", "' . $row['dob'] . '", "' . $row['address'] . '", "' . $row['phone'] . '", "' . $row['email'] . '", "' . $row['role'] . '")\'>
                                    View
                                    </button><button onclick=\'updateRedirect(' . $row['uid'] . ')\' class="table-btn">Update</button><button onclick=\'deleteRedirect(' . $row['uid'] . ')\' class="table-btn">Delete</button></td>
                                </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </table>
                        <br><br>

                        <hr style="border: 1px solid #dcc9ff; width: 100%;">
                        <p style="font-weight: bold">Admins</p>
                        <table>
                            <?php
                            if (mysqli_num_rows($result4) > 0) {

                                echo '<tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>';

                                while ($row = mysqli_fetch_assoc($result4)) {
                                    echo
                                        '<tr>
                                    <td>' . $row['uid'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>
                                    <button class="table-btn" onclick=\'viewDetails("' . $row['uid'] . '", "' . $row['username'] . '", "' . $row['fname'] . ' ' . $row['lname'] . '", "' . $row['nic'] . '", "' . $row['gender'] . '", "' . $row['dob'] . '", "' . $row['address'] . '", "' . $row['phone'] . '", "' . $row['email'] . '", "' . $row['role'] . '")\'>
                                    View
                                    </button><button onclick=\'updateRedirect(' . $row['uid'] . ')\' class="table-btn">Update</button><button onclick=\'deleteRedirect(' . $row['uid'] . ')\' class="table-btn">Delete</button></td>
                                </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </table>
                        <br><br>

                    </div>

                </div>

            </div>
        </div>

        <p class="legal-footer" style="background-color: transparent; color: #707070; padding: 20px 0 30px;">
            ©<span id="year"></span> Ceft Online. All rights reserved.
        </p>

    </div>

    <script>
        function updateRedirect(uid) {
            window.location.href = "./update_staff.php?uid=" + uid;
        }

        function deleteRedirect(uid) {
            window.location.href = "../backend/admin/staff/delete.php?uid=" + uid;
        }
    </script>

    <script>
        // view staff member details
        function viewDetails(uid, username, name, nic, gender, dob, address, phone, email, role) {

            document.getElementById('panel-name').innerHTML = name;
            document.getElementById('panel-username').innerHTML = username;
            document.getElementById('panel-nic').innerHTML = nic;
            document.getElementById('panel-gender').innerHTML = gender;
            document.getElementById('panel-dob').innerHTML = dob;
            document.getElementById('panel-address').innerHTML = address;
            document.getElementById('panel-phone').innerHTML = phone;
            document.getElementById('panel-email').innerHTML = email;

            if (role === 'cashier') {
                document.getElementById('panel-role').innerHTML = 'Cashier';
            } else if (role === 'manager') {
                document.getElementById('panel-role').innerHTML = 'Manager';
            } else if (role === 'security') {
                document.getElementById('panel-role').innerHTML = 'Cyber Security Officer';
            } else if (role === 'admin') {
                document.getElementById('panel-role').innerHTML = 'Admin';
            }

            document.getElementById('detail-panel').style.display = 'flex';
        }
    </script>

    <script>
        // alert box
        alertBox("User deleted successfully!", "User deletion failed!");

        // copyright year
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>

    </body>
    </html>

<?php

?>