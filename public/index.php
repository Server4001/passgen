<?php
define('PROJECT_ROOT', dirname(__DIR__));
require_once PROJECT_ROOT . '/vendor/autoload.php';

use BentlerDesign\Helpers\StringsHelper;

$length = 1;
if (isset($_GET['length']) && (int)$_GET['length'] > 0) {
    $length = (int)$_GET['length'];
}

$randomPassword = StringsHelper::randomPassword($length);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Random Password Generator</title>
  <meta charset="utf-8">
</head>
<body>
<form method="GET">
  <input type="number" name="length" min="1" max="100" value="<?=$length?>">
  <input type="submit" value="Get Random Password">
</form>
<h1>Your Password Is:<br><?=$randomPassword?></h1>
</body>
</html>
