<?php
include('connect.php');

$userData = ['friends' => [], 'pending' => []]; 
$usernameInput = '';

if (isset($_POST['username'])) {
    $usernameInput = $_POST['username'];

    $userQuery = "SELECT userID FROM users WHERE username = '$usernameInput'";
    $userResult = executeQuery($userQuery);
    $userRow = mysqli_fetch_assoc($userResult);

    if ($userRow) {
        $userID = $userRow['userID'];

        $friendsQuery = "SELECT u.username FROM friends f 
                         JOIN users u ON (f.requesteeID = u.userID OR f.requesterID = u.userID) 
                         WHERE (f.requesterID = '$userID' OR f.requesteeID = '$userID') AND f.status = 'accepted'";
        $friendsResult = executeQuery($friendsQuery);

        $pendingQuery = "SELECT u.username FROM friends f 
                         JOIN users u ON (f.requesteeID = u.userID OR f.requesterID = u.userID) 
                         WHERE (f.requesterID = '$userID' OR f.requesteeID = '$userID') AND f.status = 'pending'";
        $pendingResult = executeQuery($pendingQuery);

        while ($friend = mysqli_fetch_assoc($friendsResult)) {
            if ($friend['username'] !== $usernameInput) {
                $userData['friends'][] = $friend['username'];
            }
        }

        while ($pending = mysqli_fetch_assoc($pendingResult)) {
            if ($pending['username'] !== $usernameInput) {
                $userData['pending'][] = $pending['username'];
            }
        }
    } else {
        $noUserFound = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5" style="font-family: Inter;">
        <form id="usernameForm" method="post" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Enter a username to view their friends list:</label>
                <div class="input-group custom-width">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                        aria-label="Username" aria-describedby="basic-addon1"
                        value="<?php echo htmlspecialchars($usernameInput); ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">View Friends</button>
        </form>

        <?php if (isset($noUserFound) && $noUserFound): ?>
            <div class="alert alert-warning mt-4">No username found.</div>
        <?php endif; ?>

        <div id="results" class="results-header mt-4"
            style="display: <?php echo !empty($userData['friends']) || !empty($userData['pending']) ? 'block' : 'none'; ?>">
            <h2 class="text-center bold font-weight-bold"
                style="border-bottom: 2px solid #ccc; padding-bottom: 10px; margin-bottom: 15px; margin-top: 50px; weight:bold;">
                <strong>Results</strong></h2>
            <h3><strong>Friends</strong></h3>
            <?php if (!empty($userData['friends'])): ?>
                <ol id="friendsList">
                    <?php foreach ($userData['friends'] as $friend): ?>
                        <li><?php echo $friend; ?></li>
                    <?php endforeach; ?>
                </ol>
            <?php else: ?>
                <p>No friends found.</p>
            <?php endif; ?>

            <h3><strong>Pending Friend Requests</strong></h3>
            <h5 style="font-size:15px;"> The shown pending requests are either requests you've sent or requests you've received from others.</h5>
            <?php if (!empty($userData['pending'])): ?>
                <ol id="pendingRequestsList">
                    <?php foreach ($userData['pending'] as $pending): ?>
                        <li><?php echo $pending; ?></li>
                    <?php endforeach; ?>
                </ol>
            <?php else: ?>
                <p>No pending requests.</p>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>