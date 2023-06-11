<?php
    // Create a database connection
    $con = mysqli_connect('localhost', 'kiki', 'test1234', 'kiki');

    // Check for connection success
    if (!$con) {
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $qty = $_POST['qty'];
    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $address = $_POST['address'];
    $sql = "INSERT INTO `kiki`,`food` (`qty`, `fullname`, `email`, `contact`, `address`) VALUES ('$qty', '$fname', '$email', '$phone',  '$address');";

    // Execute the query: to insert data in db
    if ($con->query($sql) == true) {
        // Flag for successful insertion
        $insert = true;
    } else {
        echo "ERROR: $sql <br> $con->error";
    }

    // close conn to db after using it
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted</title>
    <style>
        :root {
            font-size: 20px;
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        p {
            margin: 0;
        }

        p:not(:last-child) {
            margin-bottom: 1.5em;
        }

        body {
            font: 1em/1.618 Inter, sans-serif;

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

            min-height: 100vh;
            padding: 30px;

            color: #224;
            background-color: #ff7700;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23cc0000' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23aa0000' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23d6002b' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23b10022' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23d9004b' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23b2003d' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23d3006c' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23ac0057' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23c4008c' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%239e0071' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23aa00aa' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23880088' points='943 900 1210 900 971 687'/%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;
        }

        .card {
            max-width: 300px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            max-width: 500px;
            height: 200px;
            padding: 35px;

            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.45);
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);

            backdrop-filter: blur(15px);
        }

        .card-footer {
            font-size: 0.65em;
            color: #446;
        }

        button {
            cursor: pointer;
            margin: 30px;
            font-size: 1rem;
            padding: .5rem;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.45);
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);
        }

        /* Table Style */
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            display: none;
            padding-left: 30px;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
   <div class="card">
        <p class='submitMsg'>Thanks for submitting your form. <strong>We are happy to see you ordering.</strong></p>
        <p class="card-footer">Created by <strong>Krithika iyer</strong>.</p>
    </div>
    <button id="btn">See All Responses</button>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kiki";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT sno, qty, fullname, email, contact, address FROM food";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Quantity</th><th>Phone</th><th>Address</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["sno"] . "</td><td>" . $row["fullname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["qty"] . "</td><td>" . $row["contact"] . "</td><td>" . $row["address"] . "</td><tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <script>
        const btn = document.getElementById('btn');
        const tbl = document.querySelector('table');

        btn.addEventListener("click", () =>{
            if (tbl.style.display === "none")
            tbl.style.display = "initial";
            else
            tbl.style.display = "none"
        })
     </script>
</body>

</html>