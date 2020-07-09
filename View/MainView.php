<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <?php
    $resourceController = new \Controller\ResourceController();
    $resources = $resourceController->GetResources();

    $gold = $resources['gold'];
    $food = $resources['food'];
    $wood = $resources['wood'];

    ?>

    <h1>Main Page</h1>
    <div>
        <p>Gold: <?= $gold['Amount']?></p>
        <p>Food: <?= $food['Amount']?></p>
        <p>Wood: <?= $wood['Amount']?></p>
    </div>
    <a href="index.php?target=index&action=home">Log Out</a>
</div>
</body>
</html>
