<!DOCTYPE html>
<html lang="et">
<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        .navbar {
            background-color: #CCCCCC; /* Hall taustavärv */
        }

        .image-container {
            display: flex;
            justify-content: space-between;
            padding: 40px; /* Võite muuta vastavalt soovile */
            height: 400px; /* Kõrgus, reguleerige vastavalt soovile */
        }

        .image-container div {
            position: relative;
            flex: 1;
            margin-right: 30px; /* Lisa soovitud vahe piltide vahele */
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Pildi asendamise viis */
           
        }
        .image-caption {
            position: absolute;
            bottom: 75px;
            right: -40px;
            font-size: 18px; /* Teksti suurus */
            border: 2px solid #ffffff; /* Piirjoon kasti ümber */
            max-width: 21%; 
            padding: 5px 10px; /* Vahemik teksti ja kasti piiri vahel */
           
            
        }
        

    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg ms-3 me-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">KeitiKommus.ee</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Avaleht</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pood</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kontakt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-dash-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6 9.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="image-container">
        <div>
            <img src="image1.jpg" alt="Image 1" class="img-fluid">
            <div class="image-caption">Vaata lähemalt</div>
        </div>
        <div>
            <img src="image2.jpg" alt="Image 2" class="img-fluid">
            <div class="image-caption">Tutvu lähemalt</div>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center">Parimad pakkumised
        </h1>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
