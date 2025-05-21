<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "vital_event");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$birth_amount = $death_amount = $divorce_amount = $marriage_amount = "";
$message = "";

// Fetch current payment info
$query = "SELECT * FROM payment_info";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['event_type']) {
            case 'birth':
                $birth_amount = $row['amount'];
                break;
            case 'death':
                $death_amount = $row['amount'];
                break;
            case 'divorce':
                $divorce_amount = $row['amount'];
                break;
            case 'marriage':
                $marriage_amount = $row['amount'];
                break;
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $birth_amount = mysqli_real_escape_string($conn, $_POST['birth']);
    $death_amount = mysqli_real_escape_string($conn, $_POST['death']);
    $divorce_amount = mysqli_real_escape_string($conn, $_POST['divorce']);
    $marriage_amount = mysqli_real_escape_string($conn, $_POST['marriage']);

    $updates = [
        "birth" => $birth_amount,
        "death" => $death_amount,
        "divorce" => $divorce_amount,
        "marriage" => $marriage_amount
    ];

    foreach ($updates as $event => $amount) {
        $stmt = $conn->prepare("UPDATE payment_info SET amount = ? WHERE event_type = ?");
        $stmt->bind_param("ds", $amount, $event);
        $stmt->execute();
        $stmt->close();
    }

    $message = "Payment information updated successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Payment Information</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
    <style>
        body {
            background-color: rgba(0, 111, 170, 0.47);
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: rgba(0, 111, 170, 0.47);
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        h5 {

        color:rgb(255, 255, 255);
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 20px;
            font-weight: bold;
        }

        .message {
            padding: 10px;
            background-color:rgba(0, 111, 170, 0.47);
            color:rgb(255, 255, 255);
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h5><center>Update Payment Information</center></h5>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="birth">Birth Amount (ETB)</label>
            <input type="number" step="0.01" class="form-control" name="birth" id="birth" value="<?= htmlspecialchars($birth_amount) ?>" required>
        </div>

        <div class="form-group">
            <label for="death">Death Amount (ETB)</label>
            <input type="number" step="0.01" class="form-control" name="death" id="death" value="<?= htmlspecialchars($death_amount) ?>" required>
        </div>

        <div class="form-group">
            <label for="divorce">Divorce Amount (ETB)</label>
            <input type="number" step="0.01" class="form-control" name="divorce" id="divorce" value="<?= htmlspecialchars($divorce_amount) ?>" required>
        </div>

        <div class="form-group">
            <label for="marriage">Marriage Amount (ETB)</label>
            <input type="number" step="0.01" class="form-control" name="marriage" id="marriage" value="<?= htmlspecialchars($marriage_amount) ?>" required>
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary">Update Payment Information</button>
        </div>
    </form>
</div>

</body>
</html>
