<?php
function randomPassword($length=12) {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = mt_rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Random Password Generator</title>
  <meta charset="utf-8">
</head>
<body>
<form method="GET">
  <input type="number" name="length" min="1" max="100" value="<?php if(isset($_GET['length']) && intval($_GET['length'])){echo intval($_GET['length']);}else{echo '1';} ?>">
  <input type="submit" value="Get Random Password">
</form>
<?php
if(isset($_GET['length']) && intval($_GET['length']) > 0) {
  echo '<h1>Your Password Is:<br>'.randomPassword(intval($_GET['length'])).'</h1>';
} else {
  echo '<h1>Your Password Is:<br>'.randomPassword().'</h1>';
}
?>
</body>
</html>
