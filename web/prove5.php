<html>
<body>

<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://postgres:password@localhost:5432/calm-plains-29594";
}

$dbopts = parse_url($dbUrl);

print "<p>$dbUrl</p>\n\n";

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

try {
 $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex) {
 print "<p>error: $ex->getMessage() </p>\n\n";
 die();
}

$statement = $db->query('SELECT user_name, password FROM users');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo 'user: ' . $row['user_name'] . ' password: ' . $row['password'] . '<br/>';
}


$statement = $db->query('SELECT showID, show_name FROM shows');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo ' show name: ' . $row['show_name'] . '<br/>';
}

$statement = $db->query('SELECT friendID, friend_name FROM friends');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo ' Friend name: ' . $row['friend_name'] . '<br/>';
}
?>

</body>
</html>