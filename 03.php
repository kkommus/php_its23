<?php
include("header.php");
?>

<?php
if (isset($_GET['page'])) {
    $page = $_GET["page"];
    if ($page=="services") {
        include("services.php");
    }elseif($page=="contact"){
        include("contact.php");
    }
}else{
?>

        <h1> Avalehe asjad</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id ad perspiciatis iste rem laborum possimus, ut reprehenderit blanditiis odio nam corrupti neque expedita tempora nisi provident aperiam eum perferendis quo!</p>


<?php
}
include("footer.php");
?>

