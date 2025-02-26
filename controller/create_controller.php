<?PHP include("../config/db.php")?>;
<?php 

$message = '';

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']). (empty($_POST['name']) && empty($_POST['password']) && empty($_POST['email']))) {
    $name = htmlspecialchars ($_POST['name']); 
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    try {
        $sql = "INSERT INTO user (user_name, user_password, user_email ) VALUES (:user_name, :user_password, :user_email)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            'user_name' => $name,
            'user_password' => $password,
            'user_email' => $email
        ]);

        if ($result) {
            $message = 'Inscription réussie!';
            header('Location: login');
            exit;
        } else {
            $message = 'Erreur lors de l\'inscription.';
        }
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}
?>
