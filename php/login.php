<?php
session_start();
header('Content-Type: application/json');
require_once 'db.php';
$database = new Database();
$db = $database->getConnection();

$respone = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

    if (!empty($email) && !empty($password)){

        $query_string = 'SELECT id, email, password, salt FROM users WHERE email = :email';
        $query = $db->prepare($query_string);

        $query->bindParam(':email', $email);

        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user){
            $hashed_password = hash('sha256', $password.$user['salt']);
            
            if($hashed_password === $user['password']){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                http_response_code(200);
                $respone = [
                    'message' => 'Zalogowany'
                ];
            }
            else{
                http_response_code(401);
                $respone = [
                    'message' => 'Hasło niepoprawne'
                ];
            }
        }
        else{
            http_response_code(404);
            $respone = [
                'message'   => 'Ten użytkownik nie istnieje w bazie danych'
            ];
        }

        
    }else{
        http_response_code(400);
        $respone = [
                'message'   => 'Nie udało się znaleźć adresu e-mail i hasła w żądaniu'
        ];
    }

}
else{
    http_response_code(500);
        $respone = [
                'message'   => 'Zła metoda połączenia. Wymagana ->POST'
        ];
}
echo json_encode($respone);
