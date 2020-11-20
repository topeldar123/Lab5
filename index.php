<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<?require_once 'engine/class/table.php';?>
<html>
    <body>
		<?
            $queryTab = "fridge";
            $headText = "Таблица холодильников";
            $arrayTitle = array("№","Марка", "Модель", "Тип разморозки", "Внутренний объем", "Срок гарантии", "Изменить", "Добавить");
            $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("</div>");
            
            $queryTab = "service";
            $headText = "Таблица сервисный центр";
            $arrayTitle = array("№","Название", "Адрес", "Изменить", "Добавить");
            $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            
            $queryTab = "repair_info";
            $headText = "Таблица заявок на ремонт";
            $arrayTitle = array("№","Дата начала ремонта", "Дата окончания", "Холодильник", "Сервисный центр", "ФИО клиента", "Cтоимость ремонта", "Изменить", "Добавить");
            $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            
            echo("<div>");
            echo("<div> <a href='gen_pdf.php'> Показать pdf </a> </div>");
            echo("<div> <a href='gen_xls.php'> Показать xls </a> </div>");
            echo("</div>");

            echo("<div>");
            echo("<div> <a href='new.php?Index="."fridge"."'> Добавить новый холодильник</a> </div>");
            echo("<div> <a href='new.php?Index="."service"."'> Добавить новый сервисный центр</a> </div>");
            echo("<div> <a href='new.php?Index="."repair"."'> Добавить заявку на ремонт</a> </div>");
            echo("</div>");

		?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>