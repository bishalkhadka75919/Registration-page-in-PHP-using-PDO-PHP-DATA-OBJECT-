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

    if(isset($_POST['loginbtn'])) {
        $error = '';

        // Getting data from the form named the following name
//make sure the name in the form matches the name in the $_POST['name']
        $username = $_POST['username'];
        $password = $_POST['password'];

            try {
                $statement = $conn->prepare('SELECT id, fullname, username, password, email FROM login WHERE username = ?');
                $statement->execute(array($username));
                $data = $statement->fetch(PDO::FETCH_ASSOC);

                    if($password == $data['password']) {
						
                        header('Location: dashboard.php');
                        exit;
                    }
                    else
                        $error= 'Password  do not match.';
                }
            
            catch(PDOException $e) {
                $error = $e->getMessage();
            }
        }
        
    
?>

<html>
<head><title>Login</title></head>
    
<body>
    
            <?php
                if(isset($error)){
                    echo '<div style="color:red;">'.$error.'</div>';
                }
            ?>
            <h1>Login</h1>
            
                <form action="" method="post">
                    <input type="text" name="username" value="" autocomplete="off"/><br /><br />
                    <input type="password" name="password" value="" autocomplete="off"/><br/><br />
                    <input type="submit" name='loginbtn' value="Login" class='submit'/><br />
                </form>
            
</body>
</html>
