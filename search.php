<!DOCTYPE html>
<html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['search'])) {
        //Get the SuperGlobal and trim leading and trailing whitespace
        $search = trim($_GET['search']);
        //check to make sure it is not empty and not null
        if (!is_null($search) && !empty($search)) {
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
                $sql = "SELECT * FROM ((bookauthorsbooks 
                    INNER JOIN bookauthors ON bookauthorsbooks.AuthorID = bookauthors.AuthorID) 
                    INNER JOIN ((bookcategoriesbooks INNER JOIN bookdescriptions ON bookcategoriesbooks.ISBN = bookdescriptions.ISBN) 
                    INNER JOIN bookcategories ON bookcategoriesbooks.CategoryID = bookcategories.CategoryID) ON bookauthorsbooks.ISBN = bookcategoriesbooks.ISBN) 
                    WHERE nameF LIKE '%$search%' OR nameL LIKE '%$search%' OR title LIKE '%$search%' OR CategoryName LIKE '%$search%'; ";

                $results = mysqli_query($connection, $sql);
                //if the input is correct
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
    if (isset($_GET['categoryName'])) {
        //Get the SuperGlobal and trim leading and trailing whitespace
        $categoryName = trim($_GET['categoryName']);
        //check to make sure it is not empty and not null
        if (!is_null($categoryName) && !empty($categoryName)) {
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
                $categoryName = trim($_GET['categoryName']);

                $sql = "SELECT * FROM ((bookauthorsbooks 
        INNER JOIN bookauthors ON bookauthorsbooks.AuthorID = bookauthors.AuthorID) 
        INNER JOIN ((bookcategoriesbooks INNER JOIN bookdescriptions ON bookcategoriesbooks.ISBN = bookdescriptions.ISBN) 
        INNER JOIN bookcategories ON bookcategoriesbooks.CategoryID = bookcategories.CategoryID) ON bookauthorsbooks.ISBN = bookcategoriesbooks.ISBN) 
        WHERE bookcategories.categoryName = '$categoryName';";

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
}
?>