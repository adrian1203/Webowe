<?php
session_start();

if (!isset($_SESSION['zalogowanyuser']))
{
    header('Location: ../index.php');
    exit();
}    
?>
    <!DOCTYPE html>
    <html lang="pl-Pl">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="Strona serwisu samochodowego">
        <title>
            Seriws samochodów
        </title>
        <link rel="stylesheet" href="../style/style.css" />
        <link rel="stylesheet" title="main" href="../style/pracownicy.css" />
        <link rel="stylesheet" href="../style/strona-glowna.css" type="text/css">
        <link rel="stylesheet" title="main" href="../style/tabelki.css" type="text/css">
        <link rel="stylesheet" title="alt" href="../style/altindex.css" type="text/css">
        <link rel="stylesheet" href="../style/dodruku.css" type="text/css" media="print">
        <script type="text/javascript" src="../wybor.js"></script>
        <script src="../jquery-3.2.1.min.js"></script>
    </head>

    <body>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#wybory').on('change', function() {
                    setStyle(this.value);
                })
            });

        </script>
        <div class="stylelista" id="stylelista">
            <select name="" id="wybory">
                <option value="" selected disabled>Wybierz styl</option>
                <option value="main" >Główny</option>
                <option value="alt" >Alternatywny</option>
            </select>

        </div>
        <nav>


            <div class="menu">

                <a id="zdjecie" href="../index.php"><img src="../galeria/menu.png" alt="zdjecie menu"></a>
                <a id="zdjecie" href="admin.php"><img src="../galeria/e-panel-logo.png" alt="zdjecie menu"></a>

                <ol>
                    <li><a class="page-scroll" href="wszystkienaprawy.php">Zrealizowane</a> </li>
                    <li><a class="page-scroll" href="oczekujace.php">Oczekujące</a> </li>
                    <li><a class="page-scroll" href="wszyscykilenci.php">Klienci</a></li>
                    <li><a class="page-scroll" href="wszyscypracownicy.php">Pracownicy</a></li>
                    <li><a class="page-scroll" href="wszystkiesamochody.php">Samochody</a></li>
                    <li><a class="page-scroll" href="dodajpracownika.php">Nowy pracownik</a></li>
                    <li><a class="page-scroll" href="../logout.php">Wyloguj</a></li>
                </ol>

            </div>
            <div class="pusty"></div>
        </nav>
        <h2>Oczekujące naprawy</h2>
        <?php
        
        require_once "../conect.php";
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        $rezultat=$polaczenie->query("SELECT * FROM fix WHERE price='0' ");

        echo"<table cellpadding=5 border=1>";
        echo"<tr><th>Numer naprawy</th><th>Data</th><th>Uszkodzenie</th><th>Klient </th><th>Samochód</th><th>Pracownik</th></tr>";
        while ($wiersz=$rezultat->fetch_assoc()) {
            $idcar=$wiersz['idcar'];
            $car=$polaczenie->query("SELECT * FROM car WHERE idcar=$idcar");
            $cartr=$car->fetch_assoc();
            $idcustomer=$wiersz['idcustomer'];
            $customer=$polaczenie->query("SELECT * FROM customer WHERE idcustomer=$idcustomer");
            $customertr=$customer->fetch_assoc();
            $iduser=$wiersz['iduser'];
            $user=$polaczenie->query("SELECT * FROM user WHERE iduser=$iduser");
            $usertr=$user->fetch_assoc();
            echo"<tr>";
            echo "<td>".$wiersz['id']." "."</td>"; 
            echo "<td>".$wiersz['date']."</td>"; 
            echo "<td>".$wiersz['what']."</td>"; 
            echo "<td>".$customertr['name']." ".$customertr['surname']."</td>";
            echo "<td>".$cartr['brand']." ".$cartr['model']."</td>";
            echo "<td>".$usertr['name']." ".$usertr['surname']."</td>";
            echo "</tr>";


        }

        echo"</table>"
        ?>

    </body>

    </html>
