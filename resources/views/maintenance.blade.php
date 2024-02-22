<!-- resources/views/maintenance.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('/path/to/your/image.jpg');
            /* Replace with the path to your image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-family: 'Arial', sans-serif;
            text-align: center;
        }

        .content {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="content">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Antu_dialog-warning.svg/1024px-Antu_dialog-warning.svg.png?20160706101740" alt="WARNING" width="50">
        <h1>Under Maintenance
        </h1>
        <p>We apologize for the inconvenience. The site is currently undergoing maintenance.</p>
        <p>Please check back later.</p>
    </div>
</body>

</html>
