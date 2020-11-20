<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
			if(isset($_GET['id'])&&isset($_GET['query'])){
                $id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['query']));
                switch($index){
                case "fridge":
                    $array = array("№", "brand", "model", "defrost_type", "internal_volume", "guarantee_period");
                    $arrayTitle = array("№","Марка", "Модель", "Тип разморозки", "Внутренний объем", "Срок гарантии");
                    $query = "SELECT * FROM $database.$index WHERE id='$id'";
                    $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    $rows = array();
                    echo("<fieldset><legend>Изменить предмет</legend>");
                    echo("<form id='form' method='post' action='save_edit.php'>");
                    while ($row=mysqli_fetch_array($result)){
                        for($i = 0; $i < count($row)/2; $i++){
                            if($i == 0){
                                echo("<input type='hidden' name='id' value='$id'> <br>");
                            } else {
                                $ar =  $row[$i];
                                echo("Изменить $arrayTitle[$i]: <input name='$array[$i]' size='50' type='text' value='$ar' maxlength='50'> <br>");
                            }
                        }
                    }
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    
                    echo("<input type='submit' value='Сохранить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                break;
                case "service":
                    $array = array("№", "name", "adress");
                    $arrayTitle = array("№","Название", "Адрес");
                    $query = "SELECT * FROM $database.$index WHERE id='$id'";
                    $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    $rows = array();
                    echo("<fieldset><legend>Изменить группу</legend>");
                    echo("<form id='form' method='post' action='save_edit.php'>");
                    while ($row=mysqli_fetch_array($result)){
                        for($i = 0; $i < count($row)/2; $i++){
                            if($i == 0){
                                print "<input type='hidden' name='id' value='$id'> <br>";
                            } else {
                                $ar =  $row[$i];
                                print "Изменить $arrayTitle[$i]: <input name='$array[$i]' size='50' type='text' value='$ar' maxlength='16'> <br>";
                            }
                        }
                    }
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    echo("<input type='submit' value='Сохранить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                break;
                case "repair_info":
                    $query_2 = "SELECT * FROM $database.$index WHERE id='$id'";
                    $index = "repair";
                    $queryTab_0 = "fridge";
                    $queryTab_1 = "service";
                    $query_0 = "SELECT * FROM $database.$queryTab_0 ORDER BY $database.$queryTab_0.id ASC";
                    $query_1 = "SELECT * FROM $database.$queryTab_1 ORDER BY $database.$queryTab_1.id ASC";
                    $result_2 = mysqli_query($link, $query_2) or die("Не могу выполнить запрос!");
                    $result_0 = mysqli_query($link, $query_0) or die("Не могу выполнить запрос!");
                    $result_1 = mysqli_query($link, $query_1) or die("Не могу выполнить запрос!");
                    $query = "SELECT * FROM $database.$index WHERE id='$id'";
                    $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    
                    $rows = array();
                    while ($row=mysqli_fetch_array($result)){
                        $rows = $row;
                    }
                    
                    $rws = array();
                    while ($row=mysqli_fetch_array($result_2)){
                        $rws = $row;
                    }
                        
                    echo("<fieldset><legend>Изменить заявку на ремонт</legend>");
                    echo("<form id='form' method='post' action='save_edit.php'>");
                    
                    echo("Изменить дата начала ремонта: <input name='date_s' type='date' value='$rows[1]'/> <br>");
                    echo("Введите дата окончания ремонта: <input name='date_e' type='date' value='$rows[2]'/> <br>");
                    
                    
                    echo("<input type='hidden' name='id' value='$id'>");
                    $id_0 = "fridge_select";
                    echo("<label for='$id_0'>Список холодильников: </label>");
                    echo("<select id='$id_0' name='$id_0'>");
                    echo("<option value=''>--Please choose an option--</option>");
                        
                    while ($row=mysqli_fetch_array($result_0)){
                        if($rws[3]==$row[1]){
                            echo("<option value='$row[0]' selected> $row[0]. $row[1]|$row[2] </option>");
                        } else{
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                    }
                    echo("</select><br>");
                    
                    $id_1 = "service_select";
                    echo("<label for='$id_1'>Список сервисных центров: </label>");
                    echo("<select id='$id_1' name='$id_1'>");
                    echo("<option value=''>--Please choose an option--</option>");
                    
                    while ($row=mysqli_fetch_array($result_1)){
                        if($rws[4]==$row[1]){
                            echo("<option value='$row[0]' selected> $row[0]. $row[1]|$row[2] </option>");
                        } else{
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                    }
                    echo("</select><br>");
                    
                    echo("Введите  ФИО клиента: <input name='fio' type='text' maxlength='64' value='$rows[5]'/> <br>");
                    echo("Введите стоимость ремонта: <input name='cost' type='number' min='250' max='9999999' value='$rows[6]'/> <br>");
                    
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    echo("<input type='submit' value='Добавить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                break;
                }
			}
		?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>