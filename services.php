<?php
include("header.php");
?>

<br>
<h1>Teenused</h1>

<?php
if (isset($_GET['ok'])) {
    echo '<div class="alert alert-success" role="alert">
    Toote lisamine õnnestus!
    </div>';
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nimetus" class="form-label">Toote nimetus</label>
        <input type="text" class="form-control" id="nimetus" name="nimetus" required>
    </div>

    <div class="mb-3">
        <label for="kirjeldus" class="form-label">Toote kirjeldus</label>
        <input type="text" class="form-control" id="kirjeldus" name="kirjeldus" required>
    </div>

    <div class="mb-3">
        <label for="hind" class="form-label">Toote hind</label>
        <input type="number" class="form-control" id="hind" name="hind" min="0.00" max="100.00" step="0.01" required>
    </div>

    <input type="hidden" name="page" value="services">

    <button type="submit" class="btn btn-success">Lisa uus toode</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nimetus = $_POST['nimetus'];
    $kirjeldus = $_POST['kirjeldus'];
    $hind = $_POST['hind'];

    // Juhusliku pildi URL-i hankimine Lorem Picsum'ist
    $image_id = rand(1, 1000); // Loob juhusliku pildi ID vahemikus 1-1000
    $image_url = "https://picsum.photos/id/{$image_id}/200/300"; // Genereerib juhusliku pildi URL-i

    // CSV faili kirjutamine
    $path = 'products.csv';
    $fp = fopen($path, 'a');
    fputcsv($fp, array($nimetus, $kirjeldus, $hind, $image_url)); // Salvestab pildi URL-i
    fclose($fp);

    // Suunab "puhtale" lehele
    header('Location: prog5.php?page=services&ok');
    exit;
}
?>

<div class="row row-cols-1 row-cols-md-4 g-4 pt-5">
    <?php
    // Faili avamine
    $products = "products.csv";
    $minu_csv = fopen($products, "r");

    // Kõikide ridade saamine feof = file-end-of-file
    while (!feof($minu_csv)) {
        // Ühe rea saamine, eraldatud komaga
        $rida = fgetcsv($minu_csv);
        if (is_array($rida)) {
            echo '
            <div class="col">
                <div class="card">
                    <img src="' . $rida[3] . '" class="card-img-top" alt="' . $rida[0] . '">
                    <div class="card-body">
                    <h5 class="card-title">' . $rida[0] . '</h5>
                    <p class="card-text">' . $rida[1] . '</p>
                    <p class="card-text">Hind:  ' . $rida[2] . '€</p>
                    <form action="" method="post">
                        <input type="hidden" name="delete_id" value="' . $rida[0] . '">
                        <button type="submit" class="btn btn-danger">Kustuta</button>
                    </form>
                    </div>
                </div>
            </div>
            ';
        }
    }
    fclose($minu_csv);

    // Kustutamisvormi töötlemine
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $rows = file($products);
        $output = '';

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if ($data[0] !== $delete_id) {
                $output .= $row;
            }
        }

        file_put_contents($products, $output);
        header("Location: {$_SERVER['PHP_SELF']}"); // Värskendab lehte pärast kustutamist
        exit;
    }
    ?>
</div>

<br>
<br>

<?php
include("footer.php");
?>
