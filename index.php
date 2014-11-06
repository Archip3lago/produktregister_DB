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
            <form method="POST">
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
            <form method="POST">
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
            <form method="POST">
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

        if (isset($_POST["update"]) and isset($_POST["pris"]) and $_POST["pris"] > 0) {
            $tmp_produktnamn_old = $_POST["name_old"];
            $tmp_produktnamn_new = filter_input(INPUT_POST, 'name_new', FILTER_SANITIZE_SPECIAL_CHARS);
            $tmp_pris = $_POST["pris"];
            if ($tmp_produktnamn_new != "") {
                $sql = 'UPDATE `produkter` SET `namn`="' . $tmp_produktnamn_new . '",`pris`=' . $tmp_pris . ' WHERE namn="' . $tmp_produktnamn_old . '"';
            } else {
                $sql = 'UPDATE `produkter` SET `pris`=' . $tmp_pris . ' WHERE namn="' . $tmp_produktnamn_old . '"';
            }
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        }

        if (isset($_POST["add"]) and $_POST["pris"] > 0) {
            $tmp_produktnamn = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $tmp_pris = filter_input(INPUT_POST, 'pris', FILTER_SANITIZE_SPECIAL_CHARS);
            $sql = 'INSERT INTO `produkter`(`id`, `namn`, `pris`) VALUES ("","' . $tmp_produktnamn . '", ' . $tmp_pris . ')';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            echo "Produkten: " . $tmp_produktnamn . " har lagts till med priset " . $tmp_pris . " :-";
        }

        if (isset($_POST["delete"])) {
            $tmp_produktnamn = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $skrivut = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $sql = 'DELETE FROM `produkter` WHERE namn ="' . $tmp_produktnamn . '"';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            echo "Produkten: " . $skrivut . " har tagits bort ur produktregistret.";
        }
        if (isset($_POST["action"]) and $_POST["action"] === "Radera") {
            $tmp_id = $_POST["id"];
            $sql = 'DELETE FROM `produkter` WHERE id ="' . $tmp_id . '"';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        }
        if (isset($_POST["action"]) and $_POST["action"] === "Redigera") {
            $tmp_id = $_POST["id"];
            $tmp_name = $_POST["namn"];
            $sql = 'DELETE FROM `produkter` WHERE id ="' . $tmp_id . '"';
            
            echo "<form method'post'>";
            echo "<input type='text' name='namn' value='". $tmp_name ."'>";
            echo "<input type='hidden' name='id' value='". $tmp_id ."'>";
            echo "<input type='submit'";

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        }

        if (!isset($_GET["hide"])) {
            $sql = "SELECT * FROM produkter";

            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $produkter = $stmt->fetchAll();

            echo "<ul>";
            foreach ($produkter as $produkt) {
                echo "<li>" . $produkt[1] . "\t" . $produkt[2] . ":-" . "<li>";
                echo "<form method='POST'>";
                echo "<input type='submit' value='Radera' name='action'>";
                echo "<input type='hidden' value='" . $produkt["id"] . "' name='id'>";
                echo "</form>";
                echo "<form method='POST'>";
                echo "<input type='submit' value='Redigera' name='action'>";
                echo "<input type='hidden' value='" . $produkt["id"] . "' name='id'>";
                echo "</form>";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>
