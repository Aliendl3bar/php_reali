<!-- session_start(); kan5aomohaa bax nloadiw xi variable f loads kamlin -->
<!-- diclarina reviews inside session bax nb9aw n loadiwha  -->


<?php
    session_start();
    function display($name, $email, $comment) {
        return "Name: " . htmlspecialchars($name) . "<br>" .
            "Email: " . htmlspecialchars($email) . "<br>" .
            "Comment: " . htmlspecialchars($comment) . "<br>";
    }
    if (!isset($_SESSION['reviews'])) {
        $_SESSION['reviews'] = [];
    }
    $result = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"] ?? 0;
        $email = $_POST["email"] ?? 0;
        $comment = $_POST["comment"] ?? 0;
        $result = display($name, $email, $comment);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>realization</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>take reviews </h1>
    <fieldset>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Comments: <textarea name="comment" required></textarea></label><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    </fieldset>

    
    <h2>Reviews List</h2>
    <?php
        if ($result !== null) {
            $_SESSION['reviews'][] = $result;
            if (count($_SESSION['reviews']) > 5) {
                array_shift($_SESSION['reviews']);
            }
        }
        foreach ($_SESSION['reviews'] as $review) {
            echo $review . "<hr>";
        }
    ?>
</body>
</html>