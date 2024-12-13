<?php
include("connect.php");

$IslandQuery = "SELECT * FROM islandContents JOIN islandsOfPersonality ON islandContents.islandOfPersonalityID = islandsOfPersonality.islandOfPersonalityID WHERE islandsOfPersonality.islandOfPersonalityID = '1';";
$IslandResult = executeQuery($IslandQuery);

$ContentQuery = "SELECT * FROM islandContents WHERE islandOfPersonalityID = '1';";
$ContentResult = executeQuery($ContentQuery);


while ($Island = mysqli_fetch_assoc($IslandResult)) {
    $content = $Island['content'];
    $image = $Island['image'];
    $color = $Island['color'];
    $name = $Island['name'];
    $shortDescription = $Island['shortDescription'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $name ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="island-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="w3-black">

    <!-- Icon Bar (Sidebar - hidden on small screens) -->
    <nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center" style="background-color: #555690;">
        <!-- Avatar image in top left corner -->
        <img src="inside-out.png" style="width:100%">
        <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-home w3-xxlarge"></i>
            <p>Home</p>
        </a>
        <a href="creativeisland.php" class="w3-bar-item w3-button w3-padding-large w3-black w3-hover-black">
            <i class="fa-solid fa-palette w3-xxlarge"></i>
            <p>Creative Island</p>
        </a>
        <a href="musicisland.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-music w3-xxlarge"></i>
            <p>Music Island</p>
        </a>
        <a href="friendshipisland.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-user-group w3-xxlarge"></i>
            <p>Friendship Island</p>
        </a>
        <a href="filmisland.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-film w3-xxlarge"></i>
            <p>Film Island</p>
        </a>
    </nav>

    <!-- Navbar on small screens (Hidden on medium and large screens) -->
    <div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
        <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
            <a href="creativeisland.php" class="w3-bar-item w3-button" style="width:25% !important">Creative</a>
            <a href="musicisland.php" class="w3-bar-item w3-button" style="width:25% !important">Music</a>
            <a href="friendshipisland.php" class="w3-bar-item w3-button" style="width:25% !important">Friendship</a>
            <a href="filmisland.php" class="w3-bar-item w3-button" style="width:25% !important">Film</a>
        </div>
    </div>

    <!-- Page Content -->
    <div class="w3-padding-large" id="main">
        <!-- Header/Home -->
        <header class="w3-container w3-padding-32 w3-center" id="home">
            <h1 class="w3-jumbo" style="font-family: Inside Out;"><span class="w3-hide-small"></span> Welcome!</h1>
            <p style="margin-top: -20px;">Woah! You are currently on my <?php echo $name ?>!</p>
        </header>

        <!-- About Section -->
        <div class="w3-content w3-justify w3-padding-64" id="about" style="margin-top: -100px;">
            <h2 class="w3-text-white">Island Information</h2>
            <hr style="width:200px" class="w3-text-white">
            <p><?php echo $shortDescription ?>
            </p>
        </div>

        <div class="w3-padding-64 w3-content" id="photos" style="margin-top: -120px;">
            <h2 class="w3-text-light-grey">Core Memories</h2>
            <hr style="width:200px" class="w3-opacity">


            <!-- Photo grid (modal) -->
            <div class="w3-container w3-center w3-margin-top">
                <div class="w3-row">

                    <?php while ($content = mysqli_fetch_assoc($ContentResult)) { ?>
                        <div class="w3-col l6 m12 s12">
                            <div class="image-container"
                                onmouseover="this.style.boxShadow='0px 0px 50px <?php echo $content['color']?>'; this.style.backgroundColor='rgba(0, 0, 0, 0.1)';"
                                onmouseout="this.style.boxShadow='none'; this.style.backgroundColor='transparent';">
                                <img src="<?php echo $content['image'] ?>"
                                    style="width:100%; transition: box-shadow 0.3s, background-color 0.3s;"
                                    onclick="onClick(this)" alt="<?php echo $content['content'] ?>">
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>



        </div>

        <!-- Modal for full size images on click-->
        <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
            <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
            <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
                <img id="img01" class="w3-image">
                <p id="caption"></p>
            </div>
        </div>


        <script>

            // Modal Image Gallery
            function onClick(element) {
                document.getElementById("img01").src = element.src;
                document.getElementById("modal01").style.display = "block";
                var captionText = document.getElementById("caption");
                captionText.innerHTML = element.alt;
            }


        </script>
</body>

</html>