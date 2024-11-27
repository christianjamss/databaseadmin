<?php
include('connect.php');
$status = "";

if (isset($_POST['btnSignIn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' && password = '$password' ";
    $result = executeQuery($query);

    if (mysqli_num_rows($result) > 0) {

        $status = "Success Login";
    } else {
        $status = "Failed Login";
    }
}

if (isset($_POST['btnEdit'])) {
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' && password = '$password' ";
    $result = executeQuery($query);

    $editQuery = "UPDATE users SET phoneNumber='$phoneNumber', email='$email' WHERE username = '$username' && password = '$password'";
    executeQuery($editQuery);

    $status = "Updated";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/16782/16782341.png">

</head>

<body>
    <div class=" row my-5 m-0 mx-5" style="font-family: Inter;">
        <div class="col">
            <div class="card p-5 text-center rounded-5 shadow">
                <div class="row">
                    <a class="btn btn-secondary " href="index.php"
                        style="font-family: Inter; font-size: 30px; width:50px; height: 50px; background-color:transparent;border-color: transparent; color:black;">
                        &larr;
                    </a>
                </div>
                <div class="row">
                    <div class="h3 mb-5" style="margin-top: -20px">Edit Profile</div>
                </div>

                <form method="POST">
                    <div> Sign in to edit profile</div>
                    <input class="my-3 form-control" placeholder="Username" name="username" type="username"
                        value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                    <input class="my-3 form-control" placeholder="Password" name="password" type="password"
                        value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                    <button class="btn btn-primary" name="btnSignIn">Sign In</button>
                    <?php if ($status == "Failed Login") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-danger p-2 my-4" style="width:500px;"> Wrong username or password.</div>
                        </div>

                    <?php } ?>
                    <?php if ($status == "Updated") { ?>
                                    
                                    <div class="row d-flex justify-content-center">
                                        <div class="alert alert-success p-2 m-0 my-4" style="width:500px;"> Successfully edited profile.</div>
                                    </div>
                                
                                <?php } ?>

                    <?php
                    if ($status == "Success Login") {
                        if (mysqli_num_rows($result) > 0) {
                            while ($profile = mysqli_fetch_assoc($result)) {
                                ?>

                                <form method="post">
                                    <input class="my-3 form-control" placeholder="Phone Number" name="phoneNumber"
                                        type="phoneNumber" value="<?php echo $profile['phoneNumber'] ?>">
                                    <input class="my-3 form-control" placeholder="Email" name="email" type="email"
                                        value="<?php echo $profile['email'] ?>">
                                    <button class="mt-5 btn btn-primary" type="submit" name="btnEdit">
                                        Save
                                    </button>
                                    
                                    
                                </form>

                                <?php
                            }
                        }
                    }

                    ?>
            </div>
        </div>
    </div>
    </div>

    <script src="https:
    <script src=" https: integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https:
        integrity=" sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>