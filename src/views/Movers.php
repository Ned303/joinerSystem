<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Joiner System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
			body {font-family: Arial, Helvetica, sans-serif;}
			
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
			}
			.MainForm {
				border: 3px solid #f1f1f1;
				width: 50%;
				margin: auto;
				border-radius: 25px;
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
				padding:20px;
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

			.form-wrapper div{
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
				padding-right:20px;
				padding-left:20px;
			}

			textarea{
				width: 100%;
			}
		</style>
    </head>
    <body>
         <br>
		<!--Following load the for-->
		<div id = "content" class = "main">
        <form action="index.php" method="POST" class="MainForm">
          <table class="container">
			<tr>
				<td><h4><b>First name:</b></h4>
					<input type="text" name="First name" required>
				</td>
			</tr>
			<tr>		
				<td><h4><b>Surname:</b></h4>
					<input type="text" name="Surname" required>
				</td>
			</tr>
			<tr>
				<td><h4><b>Current Job Title</b></h4>
					<select>
						<option value="curJob1">Junior Developer</option>
						<option value="curJob2">job2</option>
						<option value="curJob3">job3</option>
						<option value="curJob4">job4</option>
					</select>
				</td>
				<td><h4><b>New Job Title</b></h4>
					<select>
						<option value="newJob1">Junior Developer</option>
						<option value="newJob2">job2</option>
						<option value="newJob3">job3</option>
						<option value="newJob4">job4</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><h4><b>Current Department</b></h4>
					<select>
						<option value="curDep1">IT</option>
						<option value="curDep2">job2</option>
						<option value="curDep3">job3</option>
						<option value="curDep4">job4</option>
					</select>
				</td>
				<td><h4><b>New Department</b></h4>
					<select>
						<option value="newDep1">IT</option>
						<option value="newDep2">job2</option>
						<option value="newDep3">job3</option>
						<option value="newDep4">job4</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><h4><b>Current Line Manager</b></h4>
					<input type="text" name="Department" required>
				</td>
			</tr>
			<tr>
				<td><h4><b>New Line Manager</b></h4>
					<input type="text" name="Line Manager" required>
				<td>
			</tr>
			<tr>
				<td><h4><b>Move to:</b></h4>
					<select>
						<option value="move1">AMB UK Grosvenor</option>
						<option value="move2">job2</option>
						<option value="move3">job3</option>
						<option value="move4">job4</option>
					</select>
				</td>
			</tr>
           <tr>
                        <td colspan="2"><h4><b>Comments</b></h4>
                            <textarea style='resize: none;' name='comments' rows='10' cols='auto' ></textarea>
                        </td>
                    </tr>
			<tr>
				<td colspan="2"><button  type="submit">Submit</button></td>
            </tr>
            </table>
        </form>
        </div>
    </body>
</html>