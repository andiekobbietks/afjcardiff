<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Test Page</title>
</head>
<body>
    <h1>PHP Test Page</h1>
    <?php
    echo "<p>PHP is working! Current time: " . date('Y-m-d H:i:s') . "</p>";
    phpinfo();
    ?>
</body>
</html>
