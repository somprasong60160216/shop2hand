<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>

	<?php

$url = 'http://air4thai.pcd.go.th/services/getNewAQI_JSON.php?region=1'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed

echo $characters[0]->name;

foreach ($characters as $character) {
	echo $character->name . '<br>';
}

?>

<table>
	<tbody>
		<tr>
			<th>Name</th>
			<th>Race</th>
		</tr>
		<?php foreach ($characters as $character) : ?>
        <tr>
            <td> <?php echo $character->name; ?> </td>
            <td> <?php echo $character->race; ?> </td>
        </tr>
		<?php endforeach; ?>
	</tbody>
</table>
	
</body>
</html>