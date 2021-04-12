<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>My Bookstore</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src= "js/jquery-3.4.1.min.js"><\/script>');
    </script>
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

    <div class="sidebar">

        <form method="post" action="index.php">
            <input type="text" name="search" id="search">
            <br><br>
            <button type="button">Search</button>
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
                $sql = "SELECT categoryName, COUNT(categoryName) AS CalCount 
            FROM (bookcategories INNER JOIN bookcategoriesbooks ON bookcategories.CategoryID = bookcategoriesbooks.CategoryID) 
            GROUP BY categoryName;";

                $results = mysqli_query($connection, $sql);
                //if the input is correct
                if ($results != false) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        //echo "<a href='index.php?"
                        //. "categoryName=" . $row['categoryName']
                        //. "'>" . $row['categoryName'] . " (" . $row['CalCount'] . ")" . "</a>";
                        echo "<a href=\"#\" categoryName =\"" . $row['categoryName'] . "\">" . $row['categoryName'] . " " . $row['CalCount'] . "</a>";
                        echo "<br/>";
                    }
                }
            }
            mysqli_free_result($results);
            mysqli_close($connection);
            ?>
        </form>
        <p id="server_timer"></p>
    </div>

    <div class="content">
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
            if (isset($_GET['authorID'])) {
                //Get the SuperGlobal and trim leading and trailing whitespace
                $authorID = trim($_GET['authorID']);
                //check to make sure it is not empty and not null
                if (!is_null($authorID) && !empty($authorID)) {
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
                        $authorID = trim($_GET['authorID']);
        
                        $sql = "SELECT * FROM ((bookauthorsbooks 
                        INNER JOIN bookauthors ON bookauthorsbooks.AuthorID = bookauthors.AuthorID) 
                        INNER JOIN ((bookcategoriesbooks INNER JOIN bookdescriptions ON bookcategoriesbooks.ISBN = bookdescriptions.ISBN) 
                        INNER JOIN bookcategories ON bookcategoriesbooks.CategoryID = bookcategories.CategoryID) ON bookauthorsbooks.ISBN = bookcategoriesbooks.ISBN) 
                        WHERE bookauthorsbooks.AuthorID = '$authorID' GROUP BY bookdescriptions.ISBN;";
        
                        $results = mysqli_query($connection, $sql);
                        //if the input is correct
                        if ($results != false) {
                            while ($row = mysqli_fetch_assoc($results)) {
                                echo "<div class='Lists'>";
                                echo "<a href='product.php?"
                                    . "&ISBN=" . $row['ISBN']
                                    . "'>" . $row['title'] . "</a>";
                                echo "<br/>";
        
                                echo "by ";
                                echo "<a href=\"#\" authorID =\"" . $row['AuthorID'] . "\">" . $row['nameF'] . " " . $row['nameL'] . "</a>";
                                echo "<br/>";
                                echo '<div class = "container">';
                                echo '<img src="img/' . $row['ISBN'] . '.THUMB.jpg" alt="thumb">';
                                echo '<div class="more">';
                                echo "<a href='product.php?"
                                    . "&ISBN=" . $row['ISBN']
                                    . "'>" . "More..." . "</a>";
                                echo '</div>';
                                echo '<div class="desc">' . $row['description'] . " " . $row['pubdate'] . $row['edition'] . " " . $row['pages'] . '</div>';
                                echo "<br/>";
                                echo "</div>";
                                echo "</div>";
                                echo "<br/>";
                                echo "<br/>";
                            }
                            mysqli_free_result($results);
                            mysqli_close($connection);
                        }
                    }
                }
            }
            else{
                $sql = "SELECT * FROM (bookdescriptions INNER JOIN (bookauthorsbooks INNER JOIN bookauthors ON bookauthorsbooks.AuthorID = bookauthors.AuthorID) ON bookdescriptions.ISBN = bookauthorsbooks.ISBN);";
            $results = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($results)) {

                echo "<div class='Lists'>";
                echo "<a href='product.php?"
                    . "&ISBN=" . $row['ISBN']
                    . "'>" . $row['title'] . "</a>";
                echo "<br/>";

                echo "by ";
                echo "<a href=\"#\" authorID =\"" . $row['AuthorID'] . "\">" . $row['nameF'] . " " . $row['nameL'] . "</a>";
                echo "<br/>";
                echo '<div class = "container">';
                echo '<img src="img/' . $row['ISBN'] . '.THUMB.jpg" alt="thumb">';
                echo '<div class="more">';
                echo "<a href='product.php?"
                    . "&ISBN=" . $row['ISBN']
                    . "'>" . "More..." . "</a>";
                echo '</div>';
                echo '<div class="desc">' . $row['description'] . " " . $row['pubdate'] . $row['edition'] . " " . $row['pages'] . '</div>';
                echo "<br/>";
                echo "</div>";
                echo "</div>";
                echo "<br/>";
                echo "<br/>";
            }
            mysqli_free_result($results);
            mysqli_close($connection);
            }
        }
        ?>
    </div>
    <footer id="footer">
        <em>Copyright &copy; The Island Bookstore </em>
        <span> Address: 2496 Pape Ave Toronto Ontario M4E 2V5 </span>
        <span> Phone number: 416-694-3489 </span>
        <span> Email: rh0id294kt@meantinc.com </span>


    </footer>
</body>

</html>