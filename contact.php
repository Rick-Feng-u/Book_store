<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <title>Contact</title>
    <link rel="stylesheet" href="css/contact.css" />
    <script type="text/javascript" src="js/contact.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
    window.jQuery || document.write('<script src= "js/jquery-3.4.1.min.js"><\/script>');
    </script>

    </head>

    <body>
        <form method="POST" action="processContact.php" id="ContactForm">
            <fieldset>
                <legend>Contact</legend>
                <p>
                <label>Name</label><br/>
                <input type="text" name="name" id="name" placeholder="ex: Alex" class="inputHighlight"  required/>
                </p>

                <p>
                <label>Phone Number</label><br/>
                <input type="tel" name="phone" id="phone" placeholder="ex: 1-2345678910" class="inputHighlight" pattern="[0-9]{10}" required/>
                </p>

                <p>
                <label>Address</label><br/>
                <input type="text" name="address" id="address" class="inputHighlight" placeholder="ex: baker RD" required/>
                </p>

                <p>
                <label>Email</label><br/>
                <input type="email" name="email" id="email" class="inputHighlight" placeholder="ex: alex123@gmail.com" required/>
                </p>

                <p>
                <label>Message (No exceed 150 words)</label> <br/>
                <textarea placeholder="Enter a message" name="msg" id="msg" class="inputHighlight"></textarea><br/>
                </p>

                <input type="submit" class="botton">

            </fieldset>
        </form>
    </body>
</html>