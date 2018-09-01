<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        .text{
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

        .container {
            border-collapse: collapse;
            width: 100%;
        }


        .container td, #container th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .container tr:nth-child(even){
            background-color: #f2f2f2;
        }

        .container tr:hover {background-color: #ddd;}

        .container th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: rgba(0, 101, 164, 0.65);
            color: white;
            text-align: center;
        }

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id = "content" class = "main">
    <br>
    <br>
    <table class="container" width="auto" border="1">
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Edit</th>
        </tr>
        <tr>
            <td>NED</td>
            <td>Franco</td>
            <td>de la Rosa</td>
            <td>@gmail.com</td>
            <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Edit</button></td>
        </tr>
        <tr>
            <td>G</td>
            <td>Gino</td>
            <td>Lander</td>
            <td>@ymail.com</td>
            <td><button type="button"  class="btn btn-default" data-toggle="modal" data-target="#myModal">Edit</button></td>
        </tr>
    </table>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0065A4;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white">Edit User</h4>
            </div>
            <form action="index.php" method="POST">
                <div class="modal-body">
                    <div id="edit_modal">
                        Username: <br>
                        <input type="text" id="username" class="text"><br><br>


                        Name:<br>
                        <input type="text" id="name" class="text"><br><br>


                        Surname:<br>
                        <input type="text" id="surname" class="text"><br><br>


                        E-mail:<br>
                        <input type="text" id="email" class="text"><br><br>


                        Admin:<br>

                        <input type="checkbox"><br><br>

                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" data-dismiss="modal" value="Submit"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
