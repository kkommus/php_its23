<?php
include("header.php");
?>

<?php
if (isset($_GET['page'])) {
    $page = $_GET["page"];
    if ($page=="services") {
        include("services.php");
    } elseif ($page=="contact") {
        include("contact.php");
    }
} else {
?>

<br>

<div class="row justify-content-center">
    <div class="col-md-5 px-6 position-relative">
        <img src="https://picsum.photos/200/200" alt="Reklaam 1" style="width: 100%; max-width: 100%;">
        <div class="text-block position-absolute top-50 start-0 translate-middle-y p-4" style="color: white; transform: translate(0%, -50%);">
            <p><strong>parim pakkumine</strong></p>
            <h4><strong>Osta 1 saad 2</strong></h4>
            <p>The best classic dress is sale at coro</p> 
            <button type="button" class="btn btn-outline-light mt-3" style="border-radius: 0;">Vaata lähemalt</button>
        </div>
    </div>
    <div class="col-md-5 px-6 position-relative">
        <img src="https://picsum.photos/200/200" alt="Reklaam 2" style="width: 100%; max-width: 100%;">
        <div class="text-block position-absolute top-50 start-0 translate-middle-y p-4" style="color: white; transform: translate(0%, -50%);">
            <p><strong>kevad/suvi</strong></p>
            <h4><strong>kõik rohelised</strong></h4>
            <p>20% soodsamalt</p> 
            <button type="button" class="btn btn-outline-light mt-3" style="border-radius: 0;">Vaata lähemalt</button>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center">Parimad pakkumised</h1><br>
    <?php
    if (isset($_POST['nimetus'])) {
        $ajutine_fail =  $_FILES['lisapilt']['tmp_name'];
        move_uploaded_file($ajutine_fail, 'img/'.$_FILES['lisapilt']['name']);
        $read=array();

        $id = array_push($read,count(file('products.csv'))+1);

        $nimetus = array_push($read, $_POST['nimetus']);
        $kirjeldus = array_push($read, $_POST['kirjeldus']);
        $hind = array_push($read, $_POST['hind']);
        $pildinimi = array_push($read, $_FILES['lisapilt']['name']);

        $path = 'products.csv';
        $fp = fopen($path, 'a'); 
        fputcsv($fp, $read);
        fclose($fp);
        header('Location: prog5.php?page=services&ok');
        exit; // Lisatud exit, et lõpetada skripti töö pärast suunamist
    }
    ?>

    <div class="row row-cols-1 row-cols-md-4 g-4 pt-5">
        <?php
        //faili avamine
        $products = "products.csv";
        $minu_csv = fopen($products, "r");

        //kõikide ridade saamine feof = file-end-of-file
        while (!feof($minu_csv)) {
            //ühe rea saamine, eraldatud komaga
            $rida = fgetcsv($minu_csv, filesize($products), ",");
            if (is_array($rida)) {
                echo '
            <div class="col">
                <div class="card">
                    <img src="' . $rida[3] . '" class="card-img-top" alt="' . $rida[0] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $rida[0] . '</h5>
                        <p class="card-text">' . $rida[1] . '</p>
                        <p class="card-text">  ' . $rida[2] . '€</p>
                    </div>
                </div>
            </div>
            ';
            }
        }
        fclose($minu_csv);
        ?>

    </div>
    <br>
    <br>
</div>
<?php
}
include("footer.php");
?>
