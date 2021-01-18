<!DOCTYPE html>
<html>
	<head>
		<title> Query </title>
    		<meta charset="utf-8">
    		<link rel="stylesheet" type="text/css" href = "../decorate.css">	
	</head>

	<body style="font-family: 'Courier', cursive;">
		<div class="back">
			<a href="javascript:history.back()" style="color:skyblue;">Go Back</a><br><br>
		</div>

		<?php
			include_once 'db_conn.php';
			
			$query = "SELECT DISTINCT GRADE, COUNT(*) AS num_stud FROM ENROLL, COURSE, SECTION WHERE SSECTION=ID AND CSNUM=CNUM AND CNUM=" .$_POST["c_num"]. " AND ID=" .$_POST["s_num"]. " GROUP BY GRADE";
			$result = mysqli_query($link, $query);

			if (empty($result))
				die ('ERROR 401: No Records Found!');

			echo "<h1> Results </h1>";
			echo "<table border='4' style=background-color:#484d50;>
			<th width = '100';>Grades</th>
			<th width = '100';># of Students</th>
			</tr>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td style=text-align:center;>" . $row['GRADE'] . "</td>";
				echo "<td style=text-align:center;>" . $row['num_stud'] . "</td>";
				echo "</tr>";
			}
			echo "</table>"; 
			$link->close();
		?>
	</body>
</html>
