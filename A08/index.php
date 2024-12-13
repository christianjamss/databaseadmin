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
    <title>Welcome!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="w3-black">

    <!-- Page Content -->
    <div class="w3-padding-large" id="main">
        <!-- Header/Home -->
        <header class="w3-container w3-padding-32 w3-center" id="home">
            <h1 class="w3-jumbo" style="font-family: Inside Out;"><span class="w3-hide-small"></span> Welcome!</h1>
            <p style="margin-top: -20px;">It might sound weird but you're inside James' Headquarters...</p>
            <h3 style=" font-weight: bolder;">What personality island do you want to go?</h3>
        </header>

        <div class="w3-row w3-row-padding">

            <!-- Each image in its own column -->
            <div class="w3-col s12 m12 l3">
                <a href="creativeisland.php">
                    <img src="creative-island.png" alt="Creative Island" class="w3-image">
                </a>
            </div>

            <div class="w3-col s12 m12 l3">
                <a href="friendshipisland.php">
                    <img src="friendship-island.png" alt="Friendship Island" class="w3-image">
                </a>
            </div>

            <div class="w3-col s12 m12 l3">
                <a href="musicisland.php">
                    <img src="music-island.png" alt="Music Island" class="w3-image">
                </a>
            </div>

            <div class="w3-col s12 m12 l3">
                <a href="filmisland.php">
                    <img src="film-island.png" alt="Film Island" class="w3-image">
                </a>
            </div>


</body>

</html>