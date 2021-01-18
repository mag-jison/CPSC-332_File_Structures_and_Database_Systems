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

			$query = "SELECT ID, CLASSROOM, DAYS, STIME, ETIME, COUNT(*) AS num_en FROM COURSE, SECTION, ENROLL WHERE SSECTION=ID AND CNUM=CSNUM AND CNUM=" .$_POST["sc_num"];
			$result = mysqli_query($link, $query);

			if (empty($result))
				die ('ERROR 401: No Records Found!');

			echo "<h1> Results </h1>";
			echo "<table border='4' style=background-color:#484d50;>
			<th width = '150';>Section #</th>
			<th width = '150';>Classrooms</th>
			<th width = '150';>Meeting Days</th>
			<th width = '150';>Start Times</th>
			<th width = '150';>End Times</th>
			<th width = '150';>Total Enrollment</th>
			</tr>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td style=text-align:center;>" . $row['ID'] . "</td>";
				echo "<td style=text-align:center;>" . $row['CLASSROOM'] . "</td>";
				echo "<td style=text-align:center;>" . $row['DAYS'] . "</td>";
				echo "<td style=text-align:center;>" . $row['STIME'] . "</td>";
				echo "<td style=text-align:center;>" . $row['ETIME'] . "</td>";
				echo "<td style=text-align:center;>" . $row['num_en'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			$link->close();
		?>
	</body>
</html>

