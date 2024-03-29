<?php
// Kui kustutamisvormi esitatakse, siis töötle kustutamine
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $products = "products.csv";
    $rows = file($products);
    $output = '';

    foreach ($rows as $row) {
        $data = str_getcsv($row);
        if ($data[0] !== $delete_id) {
            $output .= $row;
        }
    }

    file_put_contents($products, $output);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

// Kui vorm esitatakse, siis lisa uus toode
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete_id'])) {
    $nimetus = $_POST['nimetus'];
    $kirjeldus = $_POST['kirjeldus'];
    $hind = $_POST['hind'];

    // Juhusliku pildi URL-i hankimine Lorem Picsum'ist
    $image_id = rand(1, 1000);
    $image_url = "https://picsum.photos/id/{$image_id}/200/200";

    // CSV faili kirjutamine
    $products = 'products.csv';
    $fp = fopen($products, 'a');
    fputcsv($fp, array($nimetus, $kirjeldus, $hind, $image_url));
    fclose($fp);

    // Suunab "puhtale" lehele
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teenused</title>
    <!-- Lisa siia oma stiilileht -->
    <style>
        <style>
        h1 {
            font-size: 2.5rem; /* Muudab pealkirja suurust */
            font-weight: bold; /* Muudab pealkirja paksuks */
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <br>
    <div class="container">
        <h1>Teenused</h1>

        <?php
        if (isset($_GET['ok'])) {
            echo '<div class="alert alert-success" role="alert">
            Toote lisamine õnnestus!
            </div>';
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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

            <button type="submit" class="btn btn-success">Lisa uus toode</button>
        </form>

        <div class="row row-cols-1 row-cols-md-4 g-4 pt-5">
            <?php
            // Loeb tooted CSV failist ja kuvab need kaardina
            $products = "products.csv";
            $minu_csv = fopen($products, "r");

            while (!feof($minu_csv)) {
                $rida = fgetcsv($minu_csv);
                if (is_array($rida)) {
                    echo '
                    <div class="col">
                        <div class="card">
                            <img src="' . $rida[3] . '" class="card-img-top" alt="' . $rida[0] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $rida[0] . '</h5>
                                <p class="card-text">' . $rida[1] . '</p>
                                <p class="card-text"> ' . $rida[2] . '€</p>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
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
            ?>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
