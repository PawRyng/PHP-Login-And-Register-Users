<?php
header('Content-Type: application/json');

require_once 'db.php';
$database = new Database();
$db = $database->getConnection();
$email = '';
$password = '';
$respone = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

    if (!empty($email) && !empty($password)){
        

        $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if(preg_match($email_regex, $email) && (strlen($password) >= 8)){
            $salt = bin2hex(random_bytes(25));

            $hashed_password = hash('sha256', $password.$salt);

            $query_string = "INSERT INTO users (email, password, salt) VALUES (:email, :password, :salt)";
            $query = $db->prepare($query_string);

            $query->bindParam(':email', $email);
            $query->bindParam(':password', $hashed_password);
            $query->bindParam(':salt', $salt);

            try {
                $query->execute();
                http_response_code(201);
                $respone = json_encode([
                    'message' => 'Użytkownik utworzony'
                ]);
            } catch (PDOException $error) {
                if ($error->errorInfo[1] == 1062) {
                    http_response_code(409);
                    $respone = json_encode([
                        'message' => 'Ten e-mail już istnieje w bazie danych'
                    ]);
                } else {
                    http_response_code(500);
                    $respone = json_encode([
                        'message' => 'Nieprzewidziany błąd: '. $error
                    ]);
                }
            }
        }
        else{ 
            $respone_error = [];
            if(!preg_match($email_regex, $email)){
                $respone_error[] = ['message' => 'Email musi być w formacie email'];
            }
            
            if(strlen($password) < 8){
                $respone_error[] = ['message' => 'Hasło musi mieć minimum 8 znaków'];
            }
            http_response_code(400);
            $respone = json_encode($respone_error);

        }


        

    }
    else{
        http_response_code(400);
        $respone = json_encode(
            [
                'message'   => 'Nie udało się znaleźć adresu e-mail i hasła w żądaniu'
            ]
        );
    }

}
else{
    http_response_code(405);
    $respone = json_encode(
        [
            'message'   => 'Zła metoda połączenia. Wymagana ->POST'
        ]
    );
}

echo $respone;
