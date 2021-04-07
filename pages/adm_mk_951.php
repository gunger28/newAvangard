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
            <input class="label" type="text" name="option" placeholder="Номер телефона">
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
        getStatistics($con, 7);
    }

    $days_BTN = isset($_POST['days']);
    $weeks_BTN = isset($_POST['weeks']);
    $months_BTN = isset($_POST['months']);

    if ($days_BTN) {
        $duration = 1;
        getStatistics($con, $duration);
    }

    if ($weeks_BTN) {
        $duration = 7;
        getStatistics($con, $duration);
    }

    if ($months_BTN) {
        $duration = 30;
        getStatistics($con, $duration);
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
        $query = 'SELECT name, number, mail,product,item,message,region,date
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

    function drawDiv_statistics()
    {
        echo "
<div id=\"graphs\" class=\"graphs\">
<div id=\"conversion\" class=\"graphic\" style=\"width:20%\">
    
    </div>
    <div id=\"systems\" class=\"graphic\" style=\"width:20%\">
    
</div>
<div id=\"amount_users\" class=\"graphic\" style=\"width:60%\">
    
</div>
</div>
";
    }

    function draw_statistic_btns()
    {
        echo "
        <form method=\"POST\" class=\"stat_menu_block\">
            <input type=\"submit\" name=\"days\" value=\"\" style=\" background:url(/assets/admin/day.png) no-repeat; background-size: contain;  background-position: center;\">
            <input type=\"submit\" name=\"weeks\" value=\"\" style=\" background:url(/assets/admin/week.png) no-repeat;  background-size: contain;  background-position: center;\">
            <input type=\"submit\" name=\"months\" value=\"\" style=\" background:url(/assets/admin/month.png) no-repeat;  background-size: contain;  background-position: center;\">
        </form>";
    }

    function draw_stat_modules($data)
    {
        echo "<div id=\"stat\" class=\"stat_modules_block\">";

        foreach ($data as $module => $value) {
            draw_module($module, $value);
        }
        echo "</div>";
    }

    function draw_module($img, $data_module)
    {

        echo "<div class=\"stat_module\">
              <img src=\"" . $img . "\"> <p>"
            . $data_module
            . "</p></div>";
    }

    function getStatistics($con, $duration)
    {
        draw_statistic_btns();
        drawDiv_statistics();


        $query = "select name,location,browser,system,date,amount from visiters order by date desc";

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


        $weeks = get_sql_weeks($con, $duration);
        $date_weeks = get_date_weeks($duration);

        $conversion = round($Orders_amount / $Users_amount * 100, 1);
        $visiters = mysqli_query($con, $query);
        $statistics = array(
            "Компьютеры" => $pc_amount,
            "Телефоны" => $phone_amount,
            "Неопределённые" => $unknown_sys,
            "Новые пользователи за неделю" =>  $weeks[0],
            "Новые пользователи за 2 неделю" => $weeks[1],
            "Новые пользователи за 3 неделю" => $weeks[2],
            "Новые пользователи за 4 неделю" => $weeks[3]
        );

        $data_modules = array(
            "/assets/admin/looks.png" => $Visisters_amount,
            "/assets/admin/users.png" => $Users_amount,
            "/assets/admin/orders.png" => $Orders_amount,
            "/assets/admin/convers.png" => "$conversion %"
        );


        draw_stat_modules($data_modules);

        $today = date("d-m");


        $graph_data = array(
            "Посетители" => $Users_amount,
            "Заказы" => $Orders_amount,
            "Комп." => $pc_amount,
            "Тел." => $phone_amount,
            "Неопред." => $unknown_sys,
            "$date_weeks[3] - $date_weeks[2]" => $weeks[3],
            "$date_weeks[2] - $date_weeks[1]" => $weeks[2],
            "$date_weeks[1] - $date_weeks[0]" => $weeks[1],
            "$date_weeks[0] - $today" => $weeks[0]

        );

        //if($days_BTN){
        foreach ($statistics as $statistic => $value) {

            drawRow_Statistics($statistic, $value);
        };
        // }



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

    function get_date_weeks($duration)
    {
        $date_weeks = array();

        for ($i = 1; $i < 5; $i++) {
            $date = ($duration) * $i;
            $date = "-$date days";
            $week = date('Y-m-d', strtotime($date, strtotime(date("Y-m-d"))));
            $week = date_create($week)->Format('d.m');
            array_push($date_weeks, $week);
            echo  $date_weeks[$i];
        }

        return $date_weeks;
    }


    function get_sql_weeks($con, $duration)
    {
        $weeks = array();
        $sql_weeks = array();

        for ($i = 1; $i < 5; $i++) {
            $days_for_week = $duration * $i;
            $days_for_last_week = $days_for_week - $duration+1;
            array_push($sql_weeks, mysqli_query($con, "select count(name) as amount from visiters WHERE date >= DATE_SUB(CURRENT_DATE, INTERVAL $days_for_week DAY) and date <= DATE_SUB(CURRENT_DATE, INTERVAL $days_for_last_week DAY)"));
//            echo "$days_for_week :: $days_for_last_week \\";
        }

        foreach ($sql_weeks as $week) {
            array_push($weeks,  mysqli_fetch_array($week)['amount']);
        }


        return $weeks;
    }
    ?>
    <script src="https://www.google.com/jsapi"></script>
    <script src="/scripts/graphics.js"> </script>
</body>

</html>