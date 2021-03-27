<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- Roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/styles/admin.css" />
</head>

<body>
    <div class="menu">
        <form method="POST">
            <input class="textLabel" type="text" name="option" placeholder="Номер телефона">
            <input type="submit" name="getUsers" value="Пользователи">
            <input type="submit" name="getOrders" value="Заказы">
            <input id="getStat" type="submit" name="getStatistics" value="Статистика">
        </form>
    </div>
    <?php

    $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "a316809_1");
    $statistics_BTN = isset($_POST['getStatistics']);
    $Orders_BTN = isset($_POST['getOrders']);
    $Users_BTN = isset($_POST['getUsers']);

    if ($statistics_BTN) {
        getStatistics($con);
    }

    if ($Orders_BTN) {
        getOrders($con);
    }

    if ($Users_BTN) {
        getUsers($con);
    }

    function getOrders($con)
    {

        $option = $_POST['option'];
        $query = 'SELECT name,mail,number,product,item,message,date,region
FROM 
users INNER JOIN orders ON users.id = orders.user_id';
        $option_string = "WHERE number = '$option'";

        if ($option == '') {
            $result = mysqli_query($con, $query);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $query = "$query $option_string";
            $result = mysqli_query($con, $query);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        $ordersCol_names = array(
            "ИМЯ", "НОМЕР", "ПОЧТА", "КАТЕГОРИЯ", "ТОВАР", "Сообщение", "РЕГИОН", "Дата"
        );
        drawTable_Orders($ordersCol_names, $rows);
    }

    function getUsers($con)
    {

        $option = $_POST['option'];


        $query = 'SELECT id, name, mail, number,region
FROM users';
        $option_string = "WHERE number ='$option'";

        if ($option == "") {
            $result = mysqli_query($con, $query);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $query = "$query $option_string";
            $result = mysqli_query($con, $query);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        $userCol_names = array(
            "№", "ИМЯ", "ПОЧТА", "ТЕЛЕФОН", "РЕГИОН"
        );
        drawTable_Users($userCol_names, $rows);
    }

    function drawTable_Users($col_names, $rows)
    {

        echo "<div class=\"legend\">";
        foreach ($col_names as $name) {
            drawCol_name($name);
        }
        echo "</div>";

        foreach ($rows as $row) {
            drawRow($row);
        };
    }

    function drawTable_Orders($col_names, $rows)
    {

        echo "<div class=\"legend\">";
        foreach ($col_names as $col_name) {
            drawCol_name($col_name);
        }
        echo "</div>";

        foreach ($rows as $row) {
            drawRow($row);
        };
    }

 
    function drawTable_Visiters($col_names, $rows)
    {
        echo "<div class=\"legend\">";

        foreach ($col_names as $col) {
            drawCol_name($col);
        };
        echo "</div>";

        foreach ($rows as $row) {
            drawRow($row);
        };
    }

    function drawRow_Statistics($row_name, $option)
    {
        echo  "<div class=\"row\">";
        echo  drawRow_var($row_name) . "
         " . drawRow_var($option) . "
          </div>";
    }

    function drawCol_name($name)
    {
        echo  "<p class=\"row_val\">
        " . $name . ":
        </p>";
    }

    function drawRow($rows)
    {

        echo  "<div class=\"row\" >";
        foreach ($rows as $row) {
            echo  drawRow_var($row);
        };
        echo  "
                 </div>";
    }

    function drawRow_var($row)
    {
        echo  "<p class=\"row_val\">
         " . $row . "
         </p>";
    }

    function drawDiv_statistics(){
echo "
<div id=\"graphs\" class=\"graphs\">
<div id=\"conversion\" class=\"graphic\">
    
    </div>
    <div id=\"systems\" class=\"graphic\">
    
</div>
<div id=\"amount_users\" class=\"graphic\">
    
</div>
</div>
";

    }

    function getStatistics($con)
    {
drawDiv_statistics();

        $query = "select name,location,browser,system,date,amount from visiters";

        $getSUsers = mysqli_query($con, "select COUNT(*) as couter from visiters");
        $getSOrders = mysqli_query($con, "select COUNT(*) as couter from orders");
        $getVisits = mysqli_query($con, "select sum(amount) as amount from visiters");

        $getPcs = mysqli_query($con, "select COUNT(*) as amount from visiters where system = 'Windows' or system = 'Macintosh;'");
        $getPhones = mysqli_query($con, "select COUNT(*) as amount from visiters where system = 'iPhone;' or system = 'Linux;'");

        $Users_amount = mysqli_fetch_array($getSUsers)['couter'];
        $Orders_amount = mysqli_fetch_array($getSOrders)['couter'];
        $Visisters_amount = mysqli_fetch_array($getVisits)['amount'];

        $pc_amount = mysqli_fetch_array($getPcs)['amount'];
        $phone_amount = mysqli_fetch_array($getPhones)['amount'];
        $unknown_sys = $Users_amount - $pc_amount - $phone_amount;

        $conversion = round($Orders_amount / $Users_amount*100,1);
        $visiters = mysqli_query($con, $query);
        $statistics = array(
            "Посещений" => $Visisters_amount,
            "Пользователи" => $Users_amount,
            "Заказы" => $Orders_amount,
            "Конверсия" => "$conversion %",
            "Компьютеры" => $pc_amount,
            "Телефоны" => $phone_amount,
            "Неопределённые" => $unknown_sys
        );

        $graph_data = array(
            "Посетители" => $Users_amount,
            "Заказы" => $Orders_amount,
            "Компьютеры" => $pc_amount,
            "Телефоны" => $phone_amount,
            "Неопределённые" => $unknown_sys
        );

        foreach ($statistics as $statistic => $value) {

            drawRow_Statistics($statistic, $value);
        };

        $visitersCol_names = array(
            "ИМЯ", "РЕГИОН", "Браузер", "Система ", "ДАТА ", "Посещений "
        );
        drawTable_Visiters($visitersCol_names, $visiters);
        drawGrap_dataSet($graph_data);
    }



    function drawGrap_dataSet($data)
    {
        foreach ($data as $dat => $val) {
            echo "<p class=\"conv\">" . $dat . "</p>";
            echo "<p class=\"conv\">" . $val . "</p>";
        };
    }

    ?>
    <script src="https://www.google.com/jsapi"></script>
    <script src="/scripts/graphics.js"> </script>
</body>

</html>