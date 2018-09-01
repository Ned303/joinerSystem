<?php
	session_start();
	require '../vendor/autoload.php';

	$objJobs = new JobRoles();
	$arrJobRoles = $objJobs->getJobRoles($_SESSION['company']);
?>
<html>
<head>
    <title>Joiner System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #content {

            margin: auto;
            width: 100%;
            height: 100vh;
            margin: auto;

        }

        .container {
            padding: 16px;
            border-radius: 25px;
            width: 100%;
            margin: auto;
            border-collapse: separate;
            border-spacing: 1.5em;
        }

        .MainForm {
            border: 3px solid #f1f1f1;
            width: 50%;
            margin: auto;
            border-radius: 25px;
            position: relative;
        }

        input[type=text], input[type=date] {
            width: 100%;
            padding: 12px 5px;
            margin: 0px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type=radio] {
            padding: 20px;
            display: inline-block;

        }

        select {
            font-size: 15px;
            width: 100%;
            margin-right: 120px;
            padding: 12px 5px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;

        }

        button {
            background-color: #0065A4;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        img {
            height: 100px;
            padding-left: 40%;
        }

        .radio-choice * {
            vertical-align: middle;
        }

        .form-wrapper div {
            font-size: 20px;
            clear: both;
            border: 3px solid #f1f1f1;
            width: 140px;
            margin: auto;
            border-radius: 25px;
        }

        .form-wrapper span {
            display: inline-block;
            width: 50px;
            padding-right: 20px;
            padding-left: 20px;
        }

        textarea {
            width: 100%;
        }

        #loader-section {
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
    <script>
        function showLoader() {
            document.getElementById('loader-section').style.display = "flex";
        }
    </script>
</head>
<body>
<br>
<!--Following load the for-->
<div id="content" class="main">
    <form action="index.php" method="POST" class="MainForm">
        <table class="container">
            <tr>
                <td><b>First name</b>
                    <input type="text" name="firstName" required>
                </td>
            </tr>
            <tr>
                <td><b>Surname</b>
                    <input type="text" name="surname" required>
                </td>
            </tr>
            <tr>
                <td><b>Current Department</b>
                    <input type="text" name="currentDepartment" required>
                </td>
            </tr>
            <tr>
                <td><b>Current Job Title</b>
                    <select name="currentJobTitle">
						<?php
							foreach ($arrJobRoles as $key => $role) {
								echo '<option value="' . $key . '">' . $role . '</option>';
							}
						?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Current Line Manager</b>
                    <input type="text" name="currentManager" required>
                </td>
            </tr>
            <tr>
                <td><b>New Department</b>
                    <input type="text" name="newDepartment" required>
                </td>
            </tr>
            <tr>
                <td><b>New Job Title</b>
                    <select name="newJobTitle">
						<?php
							foreach ($arrJobRoles as $key => $role) {
								echo '<option value="' . $key . '">' . $role . '</option>';
							}
						?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>New Line Manager</b>
                    <input type="text" name="newManager" required>
                <td>
            </tr>
            <tr>
                <td><b>Move Date</b>
                    <input type="date" name="MoveDate" required>
                </td>
            </tr>
            <tr>
                <td colspan="2"><b>Comments</b>
                    <textarea style='resize: none;' name='comments' rows='10' cols='auto'></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
