<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div>
        <h1>Main Page</h1>
        <div>
            <p>Gold: <span id="goldAmount"></span></p>
            <p>Food: <span id="foodAmount"></span></p>
            <p>Wood: <span id="woodAmount"></span></p>
        </div>
        <div>
            <p>Gold Mine: Level <span  id="mineLevel"></span></p>
            <button class="upgrade">Upgrade Mine!</button>
        </div>
        <div>
            <p>Farm: Level <span  id="farmLevel"></span></p>
            <button class="upgrade">Upgrade Farm!</button>
        </div>
        <div>
            <p>Lumber Camp: Level <span  id="lumberCampLevel"></span></p>
            <button class="upgrade">Upgrade Lumber Camp!</button>
        </div>
        <div>
            <a href="index.php?target=index&action=home">Log Out</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(".upgrade").click(function () {
                getLevels();
            })

            resourceTimeout();
        });

        function getResources(){
            $.ajax({
                url: 'index.php?target=resource&action=GetResources',
                success: function (result) {
                    result = JSON.parse(result);
                    var goldAmount = result.gold.Amount;
                    $('#goldAmount').html(goldAmount);
                    var foodAmount = result.food.Amount;
                    $('#foodAmount').html(foodAmount);
                    var woodAmount = result.wood.Amount;
                    $('#woodAmount').html(woodAmount);
                }
            });
        }

        function getLevels(){
            $.ajax({
                url: 'index.php?target=building&action=GetBuildingLevels',
                success: function (result) {
                    result = JSON.parse(result);
                    var mineLevel = result.gold;
                    $('#mineLevel').html(mineLevel);
                    var farmLevel = result.farm;
                    $('#farmLevel').html(farmLevel);
                    var lumberLevel = result.lumber;
                    $('#lumberCampLevel').html(lumberLevel);
                }
            });
        }

        function resourceTimeout() {
            getLevels();
            getResources();
            setInterval(function () {
                getResources();
            }, 5000);
        }
    </script>
</body>
</html>
