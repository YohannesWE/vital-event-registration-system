
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo and Convert to PDF</title>
    <!-- Include external CSS files -->
    <link rel="stylesheet" href="your_custom_styles.css">
    <!-- Include additional PHP includes if needed -->
    <?php
    	include_once 'languge.php'; 
    include 'scroll_css.php';
    include 'head_login.php';
    ?>
    <style>
        /* Inline CSS for simplicity, move these to your CSS file */
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }

        form {
            padding-top:40px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 5px;
            width: calc(100% - 22px);
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

       <center>
    <form action="convert.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="photo" accept="image/*" required>
        <button type="submit"><?= __('Convert to PDF')?></button>
    </form></center>
</body>
</html>
