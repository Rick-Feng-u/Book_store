<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product</title>
    <link href="css/prodcut.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width" />

</head>

<body>

    <header>
        <div class="logo">
            <img src="img/the-island-bookstore.svg" alt="logo">
        </div>

        <div class="header">
            <h1>The Island Bookstore</h1>
        </div>

        <nav>
            <a href="index.php">Home</a>
            <a href="contact.php">Contact us</a>
        </nav>
    </header>

    <main>
        <?php

        $host = "cosc499.ok.ubc.ca";
        $database = "db_project";
        $user = "WebUser";
        $password = "9UcM0QQcK1BwAXLk";

        $connection = mysqli_connect($host, $user, $password, $database);

        $error = mysqli_connect_error();

        if ($error != null) {
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        } else {
            if (isset($_GET['ISBN'])) {
                $ISBN = $_GET['ISBN'];
                $sql = "SELECT * FROM ((bookauthorsbooks INNER JOIN bookauthors ON bookauthorsbooks.AuthorID = bookauthors.AuthorID) INNER JOIN ((bookcategoriesbooks INNER JOIN bookdescriptions ON bookcategoriesbooks.ISBN = bookdescriptions.ISBN) INNER JOIN bookcategories ON bookcategoriesbooks.CategoryID = bookcategories.CategoryID) ON bookauthorsbooks.ISBN = bookcategoriesbooks.ISBN) WHERE bookdescriptions.ISBN = '$ISBN';";
                $results = mysqli_query($connection, $sql);

                //if the input is correct
                if ($results != false) {
                    $row = mysqli_fetch_assoc($results);

                    echo '<img src="img/' . $row['ISBN'] . '.MED.jpg" alt="thumb">';

                    echo '<div class="notDesc">';
                    echo $row['title'] . "<br/>";
                    echo "Category: " . $row['CategoryName'] . "<br/>";
                    echo "Author: ";
                    //echo "<a href=\"index.php\" authorID =\"" . $row['AuthorID'] . "\">" . $row['nameF'] . " " . $row['nameL'] . "</a>";
                    echo "<a href='index.php?". "authorID=" .$row['AuthorID']. "'>"  . $row['nameF'] . " " . $row['nameL'] .  "</a>";
                    while ($db = mysqli_fetch_assoc($results)) {
                        if ($row['nameF'] != $db['nameF'] && $row['nameL'] != $db['nameL']) {
                            echo ", " . $db['nameF'] . " " . $db['nameL'];
                        }
                    }
                    echo "</a>";
                    echo "<br/>";
                    echo "Edition: " . $row['edition'] . "<br/>";
                    echo "Publisher: " . $row['publisher'] . "<br/>";
                    echo "Publication Date: " . $row['pubdate'] . "<br/>";
                    echo "Number of pages: " . $row['pages'] . "<br/>";
                    echo "ISBN: " . $row['ISBN'] . "<br/>";
                    echo "Price: $" . $row['price'] . " Dollars " . "<br/>";
                    echo '</div>';
                    echo "<br/>";

                    echo '<div class="desc">';
                    echo $row['description'];
                    echo '</div>';
                }
            }
        }
        ?>
    </main>
    <footer id="footer">
        <em>Copyright &copy; The Island Bookstore</em>
    </footer>

</body>

</html>