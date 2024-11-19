<?php
include('connect.php');
$status = "";

if (isset($_POST['btnDelete'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $query = "SELECT userID, username, email, password FROM users WHERE username = '$username'";
    $result = executeQuery($query);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0 && $row) {
        $storedEmail = $row['email'];
        $storedPassword = $row['password'];
        $userID = $row['userID']; 

        if ($password == $confirmPassword) {
            if ($storedEmail == $email && $password == $storedPassword) {

                $deleteFriendsQuery = "DELETE FROM friends WHERE requesterID = '$userID' OR requesteeID = '$userID'";
                executeQuery($deleteFriendsQuery);

                $deleteQuery = "DELETE FROM users WHERE username = '$username'";
                executeQuery($deleteQuery);

                $_POST['username'] = $_POST['confirmPassword'] = $_POST['email'] = $_POST['password'] = '';
                $status = "Deleted";

            } else {
                $status = "Incorrect email or password";
            }
        } else {
            $status = "Passwords do not match";
        }
    } else {
        $status = "Username not found";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Account</title>
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
                    <div class="h3 mb-5">Delete your Account</div>
                </div>

                <form method="POST" onsubmit="return confirmDelete()">
                    <input class="my-3 form-control" placeholder="Username" name="username" type="username"
                        value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                    <input class="my-3 form-control" placeholder="Email" name="email" type="email"
                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <input class="my-3 form-control" placeholder="Password" name="password" type="password"
                        value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                    <input class="my-3 form-control" placeholder="Confirm Password" name="confirmPassword"
                        type="password"
                        value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : ''; ?>">
                    <button class="my-5 btn btn-danger" name="btnDelete">Delete</button>

                    <?php if ($status == "Incorrect email or password") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-danger p-2 m-0" style="width:500px;"> Incorrect email or password.</div>
                        </div>

                    <?php } else if ($status == "Username not found") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-danger p-2 m-0" style="width:500px;"> Username not found.</div>
                        
                        </div>

                    <?php } else if ($status == "Passwords do not match") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-danger p-2 m-0" style="width:500px;"> Passwords do not match.</div>

                        </div>

                    <?php } else if ($status == "Deleted") { ?>

                        <div class="row d-flex justify-content-center">
                            <div class="alert alert-success p-2 m-0" style="width:500px;"> Account deleted.</div>
                        </div>

                    <?php } ?>

                </form>

            </div>
        </div>
    </div>
    </div>

    <script>

    function confirmDelete() {
    return confirm("Are you sure you want to delete your account? This action cannot be undone.");
    }
    </script>
    <script src="https:
    <script src=" https: integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https:
        integrity=" sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>