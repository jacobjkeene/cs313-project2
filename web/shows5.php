<html>
<body>

<?php
/require("dbConnect.php");
$db = get_db();
?>

<h1>Shows</h1>

<?php
$statement = $db->query('SELECT showID, show_name FROM shows');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo ' show name: ' . $row['show_name'] . '<br/>';
}

?>

</body>
</html>