<!DOCTYPE html>
<html>
	<head>
		<title> Query </title>
    		<meta charset="utf-8">
    		<link rel="stylesheet" type="text/css" href = "../decorate.css">
		<style>
			.lefty {
				text-align: left;
			}
			.color {
				float: right;
				color: #ff6188;
			}
		</style>
	</head>

	<body style="font-family: 'Courier', cursive;">
		<div class="back">
			<a href="javascript:history.back()" style="color:skyblue;">Go Back</a><br><br>
		</div>

		<?php
			include_once 'db_conn.php';
			
			$temp = "";
			$temp2 = 0;
			$y = 0;
			$i = 0;
			$units = 0;
			$t_units = 0;
			$t_points = 0;
			$gpa = 0;
			
			$gp = array( 4, 3.7, 3.3, 3, 2.7, 2.3, 2, 1.7, 1.3, 1, 0.7, 0.0 );
			
			$query1 = "SELECT CNAME, GRADE, UNITS, ESEMESTER, EYEARS FROM ENROLL, COURSE, STUDENT, SECTION WHERE CWID=STDNT AND SSECTION=ID AND CSNUM=CNUM AND CWID=" .$_POST["cwid"]. " AND ESEMESTER='FALL' AND EYEARS='2019' ORDER BY GRADE ASC";
			$query2 = "SELECT CNAME, GRADE, UNITS, ESEMESTER, EYEARS FROM ENROLL, COURSE, STUDENT, SECTION WHERE CWID=STDNT AND SSECTION=ID AND CSNUM=CNUM AND CWID=" .$_POST["cwid"]. " AND ESEMESTER='SPRING' AND EYEARS='2020' ORDER BY GRADE ASC";
			$query3 = "SELECT CNAME, GRADE, UNITS, ESEMESTER, EYEARS FROM ENROLL, COURSE, STUDENT, SECTION WHERE CWID=STDNT AND SSECTION=ID AND CSNUM=CNUM AND CWID=" .$_POST["cwid"]. " AND ESEMESTER='SUMMER' AND EYEARS='2020' ORDER BY GRADE ASC";
			$query4 = "SELECT CNAME, GRADE, UNITS, ESEMESTER, EYEARS FROM ENROLL, COURSE, STUDENT, SECTION WHERE CWID=STDNT AND SSECTION=ID AND CSNUM=CNUM AND CWID=" .$_POST["cwid"]. " AND ESEMESTER='FALL' AND EYEARS='2020' ORDER BY GRADE ASC";
			$query5 = "SELECT CNAME, GRADE, UNITS, ESEMESTER, EYEARS FROM ENROLL, COURSE, STUDENT, SECTION WHERE CWID=STDNT AND SSECTION=ID AND CSNUM=CNUM AND CWID=" .$_POST["cwid"]. " AND ESEMESTER='SPRING' AND EYEARS='2021' ORDER BY GRADE ASC";
			
			for ($z = 0; $z < 5; $z++){
				if ($y == 0)
					$result = mysqli_query($link, $query1);
				else if ($y == 1)
					$result = mysqli_query($link, $query2);
				else if ($y == 2)
					$result = mysqli_query($link, $query3);
				else if ($y == 3)
					$result = mysqli_query($link, $query4);
				else if ($y == 4)
					$result = mysqli_query($link, $query5);
			
				if (empty($result))
					die ('ERROR 401: No Records Found!');
				
				echo "<table border='0'  style=background-color:#484d50;>
					<th width = '150' style=text-align:center;>Courses</th>
					<th width = '100' style=text-align:center;>Grades</th>
					</tr>";

					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td style=text-align:center;>" . $row['CNAME'] . "</td>";
						echo "<td style=text-align:center;>" . $row['GRADE'] . "</td>";
						echo "</tr>";
						
						if ($row['GRADE'] != 'IP'){
							$units = $row['UNITS'];
							$t_units += $row['UNITS'];
						}
						else {
							$units = 0;
							$t_units += 0;
						}
							
						if ($row['GRADE'] == "A+" || $row['GRADE'] == "A")
								$t_points += $gp[0] * $units;
							else if ($row['GRADE'] == "A-")
								$t_points += $gp[1] * $units;
							else if ($row['GRADE'] == "B+")
								$t_points += $gp[2] * $units;
							else if ($row['GRADE'] == "B")
								$t_points += $gp[3] * $units;
							else if ($row['GRADE'] == "B-")
								$t_points += $gp[4] * $units;
							else if ($row['GRADE'] == "C+")
								$t_points += $gp[5] * $units;
							else if ($row['GRADE'] == "C")
								$t_points += $gp[6] * $units;
							else if ($row['GRADE'] == "C-")
								$t_points += $gp[7] * $units;
							else if ($row['GRADE'] == "D+")
								$t_points += $gp[8] * $units;
							else if ($row['GRADE'] == "D")
								$t_points += $gp[9] * $units;
							else if ($row['GRADE'] == "D-")
								$t_points += $gp[10] * $units;
							else
								$t_points += $gp[11];
							$i++;
							$temp = $row['ESEMESTER'];
							$temp2 = $row['EYEARS'];
					}
				if ($t_units == 0)
					die ('NO DATA!');
				echo $temp, " ", $temp2;
				echo "</table>", "<br>";
				$y++;
			}
			echo "</table>", "<br>", "<br>";

			if ($t_units > 0)	
				$gpa = round(($t_points/$t_units), 2);
			round($t_points, 2);
			round($t_units, 2);
			
			echo "<table border='0' class='color' style=background-color:#171717;>
				<th class='lefty' width = '150';>Total Units</th>
				<th width = '80';>$t_units</th>
				</tr>";
				echo "<tr>
				<th class='lefty' width = '150';>Total Points</th>
				<th width = '80';>$t_points</th>
				</tr>";
				echo "<tr>
				<th class='lefty' width = '150';>GPA</th>
				<th width = '80';>$gpa</th>		
				</tr>";
			echo "</table>", "<br>";
			$link->close();
		?>
	</body>
</html>
