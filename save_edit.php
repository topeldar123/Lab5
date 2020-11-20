<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
            if(isset($_POST['id'])&&(isset($_POST['index']))){
                $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_POST['index']));
                
                switch($index){
                    case "fridge":
                        if((isset($_POST['brand']))&&(isset($_POST['model']))&&(isset($_POST['defrost_type']))&&(isset($_POST['internal_volume']))&&(isset($_POST['guarantee_period']))){
                            $brand = htmlentities(mysqli_real_escape_string($link, $_POST['brand']));
                            $model = htmlentities(mysqli_real_escape_string($link, $_POST['model']));
                            $defrost_type = htmlentities(mysqli_real_escape_string($link, $_POST['defrost_type']));
                            $internal_volume = htmlentities(mysqli_real_escape_string($link, $_POST['internal_volume']));
                            $guarantee_period = htmlentities(mysqli_real_escape_string($link, $_POST['guarantee_period']));
                            if((strlen($brand)==0)||(strlen($model)==0)||(strlen($defrost_type)==0)||(strlen($internal_volume)==0)||(strlen($guarantee_period)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET brand = '$brand', model = '$model', defrost_type = '$defrost_type', internal_volume = '$internal_volume', guarantee_period = '$guarantee_period' WHERE $database.$index.id = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                echo("<p>Thanks! You added $index.");
                                echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                    case "service":
                        if((isset($_POST['name']))&&(isset($_POST['adress']))){
                            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
                            $adress = htmlentities(mysqli_real_escape_string($link, $_POST['adress']));
                            if((strlen($name)==0)||(strlen($adress)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET name = '$name', adress = '$adress' WHERE $database.$index.id = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                echo("<p>Thanks! You added $index.");
                                echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                    case "repair":
                        if((isset($_POST['fridge_select']))&&(isset($_POST['service_select']))&&(isset($_POST['date_s']))&&(isset($_POST['date_e']))&&(isset($_POST['cost']))&&(isset($_POST['fio']))){
                            $fridge_select = htmlentities(mysqli_real_escape_string($link, $_POST['fridge_select']));
                            $service_select = htmlentities(mysqli_real_escape_string($link, $_POST['service_select']));
                            $date_s = htmlentities(mysqli_real_escape_string($link, $_POST['date_s']));
                            $date_e = htmlentities(mysqli_real_escape_string($link, $_POST['date_e']));
                            $fio = htmlentities(mysqli_real_escape_string($link, $_POST['fio']));
                            $cost = htmlentities(mysqli_real_escape_string($link, $_POST['cost']));
                            if(($fridge_select=="")||($service_select=="")||(strlen($fio)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET date_s = '$date_s', date_e = '$date_e', fridge = '$fridge_select', service = '$service_select', fio = '$fio', cost = '$cost'  WHERE $database.$index.id = '$id'";
                            echo $query;
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                echo("<p>Thanks! You added $index.");
                                echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
            }
		}
		?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>