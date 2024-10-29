<?php

$sekolah = ["TK YWKA","MI Thoriqussalam","SMPN 3 Sidoarjo","SMKN 2 Buduran"];
$sekolas = ["TK"=>"TK YWKA","SD"=>"MI Thoriqussalam","SMP"=>"SMPN 3 Sidoarjo","SMK"=>"SMKN 2 Buduran","PT"=>"Uneversitas Negri Surabaya"];
$skills = ["C++"=>"Expert","HTML"=>"Newbie","CSS"=>"Newbie","PHP"=>"Intermediate","JavaScript"=>"Intermediate"];
$identitas = ["Nama"=>"Almer Evan","Alamat"=>"Jl Diponegoro","Email"=>"almeer.evan@gmail.com","IG"=>"Alnevh9","TikTok"=>"@Zen929"];
$hobies = ["Coding","Menonton Film","Memancing","Membaca","Bermain Game"];

echo $sekolah[0];
echo "<br>";
echo $sekolas["TK"];
echo "<br>";
echo $sekolah [1];
echo "<br>";
echo $sekolas['SD'];

echo "<br>";
echo "<br>";

for ($i = 0; $i <4; $i++){
	echo $sekolah [$i];
	echo "<br>";
	
}
echo "<br>";

foreach ($sekolah as $kya){
	echo $kya;
	echo "<br>";
}
echo "<br>";

foreach ($sekolas as $key => $value){
	echo $key;
	echo "=";
	echo $value;
	echo "<br>";

}
echo "<br>";

foreach ($skills as $jay => $value){
	echo $jay;
	echo "=";
	echo $value;
	echo "<br>";
}
echo "<br>";

if (isset($_GET["menu"])){
$menu = $_GET["menu"];

echo $menu;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<hr>
	<ul>
		<li><a href="?menu=home">Home</a></li>
		<li><a href="?menu=cv">CV</a></li>
		<li><a href="?menu=project">Project</a></li>
		<li><a href="?menu=contact">Contact</a></li>
	</ul>
	<h2>Identitas</h2>
	<table border="1">
		<thead>
			<tr>
				<th>Identitas</th>
				<th>Deskripsi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($identitas as $key => $value) {
			?>
			<tr>
				<td><?= $key ?></td>
				<td><?= $value ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<hr>
	<h2>Riwayat Sekolah</h2>
	<table border="1">
		<thead>
			<tr>
				<th>Jenjang</th>
				<th>Nama Sekolah</th>
			</tr>
		</thead>
		<tbody>
			<?php

			foreach ($sekolas as $key => $value){
			echo "<tr>";
			echo "<td>";
			echo $key;
			echo "</td>";
			echo "<td>";
			echo $value;
			echo "</td>";
			echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<hr>
	<h2>Skill</h2>
	<table border="1">
		<thead>
			<tr>
				<th>Skill</th>
				<th>Level</th>
			</tr>
		</thead>
		<tbody>
			<?php

			foreach ($skills as $joy => $value){
			?>
			<tr>
				<td><?= $joy ?></td>
				<td><?= $value ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<hr>
	<h2>Hobi</h2>
	<ol>
	<?php

	foreach ($hobies as $key){
	?>
	<li><?= $key ?></li>
	<?php
	}
	?>
	</ol>
</body>
</html>