
<?php
$host = "localhost";
$username = "2455697";
$password = "Harisarita@11";
$database = "db2455697";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Set character encoding
$conn->set_charset("utf8mb4");

// Retrieve books from the database
$sql = "SELECT Book_name, Genre, Price, Date_of_release
        FROM books
        ORDER BY Book_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Books List</h1>

    <table>
        <thead>
            <tr>
                <th>Book name</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Date of release</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";

                    echo "<td>" .
                        htmlspecialchars($row["Book_name"]) .
                        "</td>";

                    echo "<td>" .
                        htmlspecialchars($row["Genre"]) .
                        "</td>";

                    echo "<td>&pound;" .
                        number_format((float)$row["Price"], 2) .
                        "</td>";

                    $date = date(
                        "d/m/Y",
                        strtotime($row["Date_of_release"])
                    );

                    echo "<td>" . $date . "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No books found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
