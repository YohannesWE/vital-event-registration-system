<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Vital Event</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #007bff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: white;
            text-decoration: none;
            padding: 10px;
        }

        .header a:hover {
            background-color: #0056b3;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
        }

        .menu {
            display: flex;
            list-style: none;
            margin-right: 20px;
            flex-wrap: wrap;
        }

        .menu li {
            margin-left: 10px;
        }

        .menu a {
            color: #333;
            text-decoration: none;
            padding: 10px;
        }

        .menu a:hover {
            background-color: #f2f2f2;
        }

        .logout a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #4CAF50;
            border-radius: 4px;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 20px;
            cursor: pointer;
        }

        .hamburger .line {
            width: 100%;
            height: 2px;
            background-color: white;
        }

        @media screen and (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                align-items: center;
                background-color: #f2f2f2;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                padding: 20px 0;
                transition: all 0.3s ease;
            }

            .menu.active {
                display: flex;
            }

            .menu li {
                margin: 10px 0;
            }

            .menu a {
                color: #333;
            }

            .menu a:hover {
                background-color: #ccc;
            }

            .menu-icon {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            .hamburger.active .line:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active .line:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }

            .hamburger.active .line:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -5px);
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="">Customer Page</a>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="menu">
            <li><a href="register_vital_event_birth.php">Register Birth</a></li>
            <li><a href="child.php">Child's Birth</a></li>
            <li><a href="register_vital_event_divorce.php">Register Divorce</a></li>
            <li><a href="register_vital_event_merrage.php">Register Marriage</a></li>
            <li><a href="customer.php">Back</a></li>
            <li class="logout"><a href="logout.php">Logout</a></li>
        </ul>
    </header>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const menu = document.querySelector('.menu');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            menu.classList.toggle('active');
        });
    </script>
</body>

</html>