<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
			if(isset($_GET['Index'])){
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['Index']));
                switch($index){
                    case "fridge":
                        echo("<fieldset><legend>Добавить новый холодильник</legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите марку: <input name='brand' type='text' maxlength='50'/> <br>");
                        echo("Введите модель: <input name='model' type='text' maxlength='50'/> <br>");
                        echo("Введите тип разморозки: <input name='defrost_type' type='text' maxlength='50'/> <br>");
                        echo("Введите  внутренний объем: <input name='internal_volume' type='text' maxlength='50'/> <br>");
                        echo("Введите срок гарантии: <input name='guarantee_period' type='text' maxlength='50'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "service":
                        echo("<fieldset><legend>Добавить новый сервисный центр</legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите название: <input name='name' type='text' maxlength='32'/> <br>");
                        echo("Введите адрес: <input name='adress' type='text' maxlength='32'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "repair":
                        $queryTab_0 = "fridge";
                        $queryTab_1 = "service";
                        $query_0 = "SELECT * FROM $database.$queryTab_0 ORDER BY $database.$queryTab_0.id ASC";
                        $query_1 = "SELECT * FROM $database.$queryTab_1 ORDER BY $database.$queryTab_1.id ASC";
                        $result_0 = mysqli_query($link, $query_0) or die("Не могу выполнить запрос!");
                        $result_1 = mysqli_query($link, $query_1) or die("Не могу выполнить запрос!");
                        echo("<fieldset><legend>Добавить заявку на ремонт</legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        
                        echo("Введите дата начала ремонта: <input name='date_s' type='date'/> <br>");
                        echo("Введите дата окончания ремонта: <input name='date_e' type='date'/> <br>");
                        
                        
                        $id_0 = "fridge_select";
                        echo("<label for='$id_0'>Список холодильников: </label>");
                        echo("<select id='$id_0' name='$id_0'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_0)){
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                        echo("</select><br>");
                        $id_1 = "service_select";
                        echo("<label for='$id_1'>Список сервисных центров: </label>");
                        echo("<select id='$id_1' name='$id_1'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_1)){
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                        echo("</select><br>");
                        
                        
                        echo("Введите  ФИО клиента: <input name='fio' type='text' maxlength='64' /> <br>");
                        echo("Введите стоимость ремонта: <input name='cost' type='number' min='250' max='9999999' value='999'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
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