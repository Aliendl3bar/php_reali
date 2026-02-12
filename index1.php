<?php
    $reviewsFile = 'reviews.txt'?? 'reviews.json';

    
    function loadReviews($file) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            return json_decode($content, true) ?? [];
        }
        return [];
    }

    // Save reviews to file  + json pretty print ( bax yt9ra mzyan )
    function saveReviews($file, $reviews) {
        file_put_contents($file, json_encode($reviews, JSON_PRETTY_PRINT));
    }


    function display($name, $email, $comment) {
        return [
            'name' => $name,
            'email' => $email,
            'comment' => $comment,
            'timestamp' => date('Y-m-d H:i')
        ];
    }

    // Load reviews
    $allReviews = loadReviews($reviewsFile);
    $result = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"] ?? '';
        $email = $_POST["email"] ?? '';
        $comment = $_POST["comment"] ?? '';
        
        if (!empty($name) && !empty($email) && !empty($comment)) {
            $result = display($name, $email, $comment);
            $allReviews[] = $result;
            saveReviews($reviewsFile, $allReviews);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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
        //a5ir 5
        $recentReviews = array_slice($allReviews, -5);
        //reverse 
        $recentReviews = array_reverse($recentReviews);
        
        foreach ($recentReviews as $review) {
            echo "Name: " . htmlspecialchars($review['name']) . "<br>";
            echo "Email: " . htmlspecialchars($review['email']) . "<br>";
            echo "Comment: " . htmlspecialchars($review['comment']) . "<br>";
            echo "Date: " . htmlspecialchars($review['timestamp']) . "<br>";
            echo "<hr>";
        }
    ?>
</body>
</html>