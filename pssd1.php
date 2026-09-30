<!DOCTYPE html>
<html>
<head>
    <title>Password Strength Checker</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px gray;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        input[type="password"] {
            width: 90%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #aaa;
            border-radius: 6px;
        }

        input[type="submit"] {
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .weak {
            color: red;
            font-weight: bold;
        }

        .medium {
            color: orange;
            font-weight: bold;
        }

        .strong {
            color: green;
            font-weight: bold;
        }

        .suggestions {
            text-align: left;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Password Strength Checker</h1>

    <form method="post">

        <label>Enter Password:</label><br>

        <input type="password" name="password"
               placeholder="Enter your password" required>

        <br>

        <input type="submit" value="Check Strength">

    </form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password = $_POST["password"];

    $score = 0;
    $suggestions = array();
    if (strlen($password) >= 8) {
        $score++;
    } else {
        $suggestions[] = "Use at least 8 characters.";
    }
    if (preg_match("/[A-Z]/", $password)) {
        $score++;
    } else {
        $suggestions[] = "Add at least one uppercase letter.";
    }
    if (preg_match("/[a-z]/", $password)) {
        $score++;
    } else {
        $suggestions[] = "Add at least one lowercase letter.";
    }
    if (preg_match("/[0-9]/", $password)) {
        $score++;
    } else {
        $suggestions[] = "Add at least one digit.";
    }
    if (preg_match("/[^A-Za-z0-9]/", $password)) {
        $score++;
    } else {
        $suggestions[] = "Add at least one special character.";
    }.                                          
    if ($score <= 2) {
        $strength = "Weak";
        $class = "weak";
    }
    elseif ($score <= 4) {
        $strength = "Medium";
        $class = "medium";
    }
    else {
        $strength = "Strong";
        $class = "strong";
    }

    echo "<div class='result'>";

    echo "<h2>Password Strength:</h2>";
    echo "<p class='$class'>$strength</p>";

    echo "<p><b>Strength Score:</b> $score / 5</p>";

    if (!empty($suggestions)) {

        echo "<div class='suggestions'>";
        echo "<h3>Suggestions for Improvement:</h3>";
        echo "<ul>";

        foreach ($suggestions as $suggestion) {
            echo "<li>$suggestion</li>";
        }

        echo "</ul>";
        echo "</div>";

    } else {

        echo "<p>✓ Your password meets all security requirements.</p>";
        echo "<p><b>Excellent! Your password is strong.</b></p>";
    }

    echo "</div>";
}

?>

</div>

</body>
</html>
