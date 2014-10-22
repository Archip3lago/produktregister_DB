<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shizzle</title>
        <style>
            * {list-style-type:none; font-family: Comic Sans MS;}
            div{
                padding: 5px;
                float:left;
                margin: 5px;
            }
            
            .border{
                border: 2px solid black;
            }
            
        </style>
    </head>
    <body>
        
        <div class="border">
            <h2>Lägg till</h2>
            <form>
                <p>Produktnamn:</p>
                <input type="text" name="name">
                <br>
                <p>Pris:</p>
                <input type="number" name="pris">
                <br>
                <input type="submit" name="add">
            </form>
        </div>

        <div class="border">
            <h2>Uppdatera</h2>
            <form>
                <p>Gammalt produktnamn:</p>
                <input type="text" name="name_old">
                <br>
                <p>Nytt produktnamn:</p>
                <input type="text" name="name_new">
                <p>Pris:</p>
                <input type="number" name="pris">
                <br>
                <input type="submit" name="update">
            </form>
            
        </div>
        
        <div class="border">
            <h2>Ta bort</h2>
            <p>Produktnamn: </p>
            <form>
            <input type="text" name="name">
            <input type="submit" name="delete">
            </form>
        </div>
        <div id="visa">

            <h2>Produkter</h2>
            <a href="index.php?hide">Dölj Produkter</a>
            
        </div>

        <?php
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "produkt_register");

        $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

        if(isset($_GET["update"]) and isset($_GET["pris"]) and $_GET["pris"] > 0){
            $tmp_produktnamn_old = $_GET["name_old"];
            $tmp_produktnamn_new = $_GET["name_new"];
            $tmp_pris = $_GET["pris"];
            if($tmp_produktnamn_new != ""){
            $sql = 'UPDATE `produkter` SET `namn`="'. $tmp_produktnamn_new .'",`pris`='. $tmp_pris . ' WHERE namn="'. $tmp_produktnamn_old .'"';
            }
            else{
                $sql = 'UPDATE `produkter` SET `pris`='. $tmp_pris . ' WHERE namn="'. $tmp_produktnamn_old .'"';
            }
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        }
        
        if(isset($_GET["add"]) and $_GET["pris"] > 0){
            $tmp_produktnamn = $_GET["name"];
            $tmp_pris = $_GET["pris"];
            $sql = 'INSERT INTO `produkter`(`id`, `namn`, `pris`) VALUES ("","' . $tmp_produktnamn .'", ' . $tmp_pris .')';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            
            echo "Produkten: " . $tmp_produktnamn . " har lagts till med priset " . $tmp_pris . " :-";
        }
        
        if(isset($_GET["delete"])){
            $tmp_produktnamn = $_GET["name"];
            $sql = 'DELETE FROM `produkter` WHERE namn ="' . $tmp_produktnamn . '"';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            
            echo "Produkten: " . $tmp_produktnamn . " har tagits bort ur produktregistret.";
        }
        
        if (!isset($_GET["hide"])) {
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
