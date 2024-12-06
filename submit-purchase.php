<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $boat = htmlspecialchars($_POST['boat']);
    $payment = $_POST['payment'];
    $card_id = htmlspecialchars($_POST['card_id']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h1>Invalid email format!</h1>";
        exit();
    }


    try {
        $conn = new PDO("mysql:host=localhost;dbname=bad_ui", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO payments (user_id, card_id, payment_method, amount, created_at) 
                                VALUES (:user_id, :card_id, :payment_method, :amount, NOW())");

        $user_id = 1;
        $amount = 5000;

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':card_id', $card_id);
        $stmt->bindParam(':payment_method', $payment);
        $stmt->bindParam(':amount', $amount);


        $stmt->execute();


        echo "<h1>Thank you for your purchase, $name!</h1>";
        echo "<p>You have chosen to buy the $boat using $payment as your payment method.</p>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
