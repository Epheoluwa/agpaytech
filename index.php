<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agpaytech</title>
</head>
<body>
    <h2>Upload Currency</h2>
    <form action="api/Insert.php" method="post" enctype="multipart/form-data">
        <input type="file" name="currency" accept=".csv" required>
        <input type="submit" value="upload" name="upload">
    </form>
    

    <br>
    <h2>Upload Country</h2>
    <form action="api/InsertCountry.php" method="post" enctype="multipart/form-data">
        <input type="file" name="currency" accept=".csv" required>
        <input type="submit" value="upload" name="upload">
    </form>
    
</body>
</html>