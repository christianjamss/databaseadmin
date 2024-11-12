<?php
include('connect.php');
$status = "";

if (isset($_POST['btnSignUp'])) {
    $username = $_POST['username'];

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = executeQuery($query);

    if (mysqli_num_rows($result) > 0) {

        $status = "Username taken";
    } else {
        $username = $_POST['username'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $blogQuery = "INSERT INTO users(username, phoneNumber, email, password) VALUES ('$username', '$phoneNumber', '$email', '$password')";
        executeQuery($blogQuery);

        $_POST['username'] = $_POST['phoneNumber'] = $_POST['email'] = $_POST['password'] = '';

        $status = "Success";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/16782/16782341.png">

</head>

<body>
    <div class=" row my-5 m-0 mx-5" style="font-family: Inter;">
        <div class="col">
            <div class="card p-3 text-center rounded-5 shadow">
                <div class="row">
                    <a class="btn btn-secondary " href="index.php"
                        style="font-family: Inter; font-size: 30px; width:50px; height: 50px; background-color:transparent;border-color: transparent; color:black;">
                        &larr;
                    </a>
                </div>
                <div class="row">
                    <div class="h3 mb-5">Sign up</div>
                </div>

                <form method="POST">
                    <input class="my-3 form-control" placeholder="Username" name="username" type="username"
                        value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                    <?php if ($status == "Username taken") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-danger p-2 m-0" style="width:500px;"> Username is already taken. Please
                                choose another one.</div>
                        </div>

                    <?php } ?>
                    <input class="my-3 form-control" placeholder="Phone Number" name="phoneNumber" type="phoneNumber"
                        value="<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : ''; ?>">
                    <input class="my-3 form-control" placeholder="Email" name="email" type="email"
                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <input class="my-3 form-control" placeholder="Password" name="password" type="password"
                        value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                    <button class="my-5 btn btn-primary" name="btnSignUp">Sign Up</button>
                    <?php if ($status == "Success") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-success p-2 m-0" style="width:500px;"> Successfully signed up.</div>
                        </div>

                    <?php } ?>
                </form>

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