<?php
session_start();
require '../vendor/autoload.php';

$companyId = $_SESSION['company'];

$objUsers = new User();
$arrUsers = $objUsers->getAllUsersForCompany($companyId);
?>
<html>
<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .text {
            width: 100%;
        }

        #content {
            margin: auto;
            width: 100%;
            height: 100vh;
        }

        #edit_modal {
            padding: 16px;
            margin: auto;
        }

        .adminContainer {
            border-collapse: collapse;
            margin: auto;
        }

        .adminContainer td, #adminContainer th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .adminContainer tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .adminContainer tr:hover {
            background-color: #ddd;
        }

        .adminContainer th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #0065A4;
            color: white;
            text-align: center;
        }

        #loader-section-add, #loader-section-remove, #loader-section-edit, #loader-section-pass {
            background: grey;
            position: absolute;
            top: 0;
            z-index: 1;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.5;
            display: none;
            align-items: center;
            border-radius: 25px;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #0065A4;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
            margin-left: auto;
            margin-right: auto;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#edit').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);// Button that triggered the modal
                var id = button.data('id');
                var username= button.data('username');
                var name = button.data('name');
                var surname= button.data('surname');
                var email= button.data('email');
                var admin= button.data('admin');

                var modal = $(this);
                modal.find('.modal-body #username').val(username);
                modal.find('.modal-body #userId').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #surname').val(surname);
                modal.find('.modal-body #email').val(email);
                modal.find('.modal-body #admin').prop('checked', admin);
            })
        });

        $(document).ready(function(){
            $('#passReset').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);// Button that triggered the modal
                var email = button.data('email');

                var modal = $(this);
                modal.find('.modal-body #email').val(email);
            })
        });

        $(document).ready(function(){
            $('#remove').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);// Button that triggered the modal
                var id = button.data('id');

                var modal = $(this);
                modal.find('.modal-body #id').val(id);
            })
        });

        function showLoaderAdd() {
            document.getElementById('loader-section-add').style.display = "flex";
        }
        function showLoaderRemove() {
            document.getElementById('loader-section-remove').style.display = "flex";
        }
        function showLoaderEdit() {
            document.getElementById('loader-section-edit').style.display = "flex";
        }
        function showLoaderPass() {
            document.getElementById('loader-section-pass').style.display = "flex";
        }
        
        function validateForm() {
            var x = document.forms["add"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("Not a valid e-mail address");
                return false;
            }
        }
    </script>
</head>
<body>
<div id="content" class="main">
    <br>
    <br>
    <table class="adminContainer" width="auto" border="1">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <col width="35%">
        <col width="200;">
        <tr class="addUser">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center;"><input type="image" src="../images/add.png" alt="Submit" width="38"
                                                   height="38" data-toggle="modal" data-target="#add"></td>
        </tr>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th style="width: auto">Edit</th>
        </tr>
        <?php
        foreach ($arrUsers as $key => $user) {
            echo "<tr>
                        <td>" . $user['userUsername'] . "</td>
                        <td>" . $user['userName'] . "</td>
                        <td>" . $user['userSurname'] . "</td>
                        <td>" . $user['userEmail'] . "</td>
                        <td style=\"width: auto; text-align: center\">
                            <input type=\"image\" src=\"../images/edit.png\" alt=\"Submit\" width=\"38\" height=\"38\" data-toggle=\"modal\" data-target=\"#edit\" data-id=\"$key\" data-username=\"" . $user['userUsername'] . "\" data-name=\"" . $user['userName'] . "\" data-surname=\"" . $user['userSurname'] . "\" data-email=\"" . $user['userEmail'] . "\" data-admin=\"" . $user['isAdmin'] . "\">
                            <input type=\"image\" src=\"../images/changePass.png\" alt=\"Submit\" width=\"38\" height=\"38\" data-toggle=\"modal\" data-target=\"#passReset\" data-email=\"" . $user['userEmail'] . "\">
                            <input type=\"image\" src=\"../images/remove.png\" alt=\"Submit\" width=\"38\" height=\"38\" data-toggle=\"modal\" data-target=\"#remove\" data-id=\"$key\">
                        </td>
                    </tr>";
        }
        ?>
    </table>
</div>

<div class="modal fade" id="add" role="dialog">
    <div class="modal-dialog">
        <div id="loader-section-add">
            <div class="loader"></div>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0065A4;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white">Add User</h4>
            </div>
            <form action="../index.php" method="POST" name="add" onsubmit="return validateForm();showLoaderAdd();">
                <div class="modal-body">
                    <div id="add_modal">
                        Username: <br>
                        <input type="text" id="username" class="text" name="username"><br><br>


                        Name:<br>
                        <input type="text" id="name" class="text" name="name"><br><br>


                        Surname:<br>
                        <input type="text" id="surname" class="text" name="surname"><br><br>


                        E-mail:<br>
                        <input type="text" id="email" class="text" name="email"><br><br>


                        Admin:<br>

                        <input type="checkbox" name="admin"><br><br>

                        <input type="hidden" name="company" value="<?php echo $companyId; ?>"/>

                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="addUser" class="btn btn-default" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog">
        <div id="loader-section-edit">
            <div class="loader"></div>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0065A4;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white">Edit User</h4>
            </div>
            <form action="../index.php" method="POST" onsubmit="showLoaderEdit();">
                <div class="modal-body">
                    <div id="edit_modal">
                        <input type="hidden" id="userId" name="userId" value="" />

                        Username: <br>
                        <input type="text" id="username" name="username" class="text"><br><br>


                        Name:<br>
                        <input type="text" id="name" name="name" class="text"><br><br>


                        Surname:<br>
                        <input type="text" id="surname" name="surname" class="text"><br><br>


                        E-mail:<br>
                        <input type="text" id="email" name="email" class="text"><br><br>


                        Admin:<br>

                        <input type="checkbox" id="admin" name="admin"><br><br>

                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="editUser" class="btn btn-default" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="passReset" role="dialog">
    <div class="modal-dialog">
        <div id="loader-section-pass">
            <div class="loader"></div>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0065A4;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white">Password Reset</h4>
            </div>
            <form action="../index.php" method="POST" onsubmit="showLoaderPass()">
                <div class="modal-body">
                    <p>Are you sure you want to reset password</p>
                    <input type="hidden" id="email" name="email" value="" />
                </div>
                <div class="modal-footer">
                    <input type="submit" name="adminPassReset" class="btn btn-default" value="Yes">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="remove" role="dialog">
    <div class="modal-dialog">
        <div id="loader-section-remove">
            <div class="loader"></div>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0065A4;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white">Remove Account</h4>
            </div>
            <form action="../index.php" method="POST" onsubmit="showLoaderRemove()">
                <div class="modal-body">
                    <p>Are you sure you want to remove account?</p>
                    <input type="hidden" id="id" name="id" value="" />
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" name="removeUser" value="Yes">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
