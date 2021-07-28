<?php
session_start();

// Define localhost, databaseuser, database user and database name
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'test');

// Connecting to above mentioned database
try {
    $conn = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//if any error occured
catch(PDOException $e) {
    echo $e->getMessage();
}


//to check whether the button is clicked or not
    if(isset($_POST['registerbtn'])) {
        

        // Getting data from the form named the following name
//make sure the name in the form matches the name in the $_POST['name']

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
try {
                $statement = $conn->prepare('INSERT INTO login (fullname, username, password, email) VALUES (?, ?, ?, ?)');
                $statement->execute(array( $fullname, $username, $password, $email
                    ));
                header('Location: index.php');
                exit;
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
?>
<html>
<head><title>Register</title></head>
<body>
                <form action="" method="post">
                    <input type="text" name="fullname" placeholder="Fullname" value="" autocomplete="off" /><br /><br />
                    <input type="text" name="username" placeholder="Username" value="" autocomplete="off" /><br /><br />
                    <input type="password" name="password" placeholder="Password" value=""/><br/><br />
                    <input type="text" name="email" placeholder="Email" value="" autocomplete="off" /><br /><br />
                    <input type="submit" name='registerbtn' value="Register" class='submit'/><br />
                </form>
</body>
</html>