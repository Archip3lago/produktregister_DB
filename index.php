<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shizzle</title>
        <style>
            * {list-style-type:none;}
            /*           div {width: 500px; float:left; border: 2px solid }*/
        </style>
    </head>
    <body>
        <div>

            <h2>Produkter</h2>
            <a href="index.php?visa">Visa</a>

        </div>
        <div>
            <h2>Lägg till</h2>
            <form>
                <p>Produktnamn:</p>
                <input type="text" name="name">
                <br>
                <p>Pris:</p>
                <input type="text" name="pris">
                <br>
                <input type="submit" name="add">
            </form>
        </div>


        <?php
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "produkt_register");
//        try {

        $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

//            if (empty($dbh)) {
//                throw new Exception("PDO kunde inte skapas");
//            } else {
//                
//                
//            }
//        } catch (Exception $e) {
//            throw new Exception("Anslutning misslyckades: " . $e->getMessage());
//        }
//urvalsfråga SQL
        if(isset($_GET["add"])){
            $tmp_produktnamn = $_GET["name"];
            $tmp_pris = $_GET["pris"];
            $sql = 'INSERT INTO `produkter`(`id`, `namn`, `pris`) VALUES ("","' . $tmp_produktnamn .'", ' . $tmp_pris .')';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            echo $tmp_produktnamn . $tmp_pris . '<br>';
            echo $sql;
        }
        
        
        if (isset($_GET["visa"])) {
            $sql = "SELECT * FROM produkter";

            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $produkter = $stmt->fetchAll();

            echo "<ul>";
            foreach ($produkter as $produkt) {
                echo "<li>" . $produkt[1] . "\t" . $produkt[2] . ":-" . "<li>";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>
