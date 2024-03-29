<?php
// Kui kustutamisvormi esitatakse, siis töötle kustutamine
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $products = "products.csv";
    $rows = file($products);
    $output = '';

    foreach ($rows as $row) {
        $data = str_getcsv($row);
        // Kontrolli, kas rea esimene element (toote ID) vastab kustutatavale ID-le
        if ($data[0] !== $delete_id) {
            $output .= $row;
        }
    }

    // Kirjuta ülejäänud read faili
    file_put_contents($products, $output);
    // Suuna tagasi samale lehele
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

// Kui vorm esitatakse, siis lisa uus toode
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete_id'])) {
    $nimetus = $_POST['nimetus'];
    $kirjeldus = $_POST['kirjeldus'];
    $hind = $_POST['hind'];
    $pilt = $_POST['pilt'];

    // CSV faili kirjutamine
    $products = 'products.csv';
    $fp = fopen($products, 'a');
    fputcsv($fp, array($nimetus, $kirjeldus, $hind, $pilt));
    fclose($fp);

    // Suunab "puhtale" lehele
    header('Location: ' . $_SERVER['PHP_SELF'] . '?ok');
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
        h1 {
            font-size: 2.5rem; /* Muudab pealkirja suurust */
            font-weight: bold; /* Muudab pealkirja paksuks */
        }
        .card-img-top {
            width: 200px; /* Muudab pildi laiust */
            height: 200px; /* Muudab pildi kõrgust */
            object-fit: cover; /* Tagab, et pilt kuvatakse täpselt määratud suuruses, ilma moonutusteta */
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

            <div class="mb-3">
                <label for="pilt" class="form-label">Vali pilt</label>
                <select class="form-control" id="pilt" name="pilt" required onchange="showImagePreview(this)">
                    <option disabled selected>Vali pilt</option>
                    <?php
                    // Kuvab kõik pildid kaustast img/
                    $image_files = glob('img/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach ($image_files as $image) {
                        $image_name = basename($image);
                        echo '<option value="' . $image . '">' . $image_name . '</option>';
                    }
                    ?>
                </select>
                <div id="imagePreview" class="mt-3"></div>
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

    <script>
    function showImagePreview(select) {
        var imagePreview = document.getElementById('imagePreview');
        var selectedImage = select.value;
        var imageHTML = '<img src="' + selectedImage + '" style="max-width: 100%; max-height: 200px;">';
        imagePreview.innerHTML = imageHTML;
    }
    </script>
</body>
</html>
