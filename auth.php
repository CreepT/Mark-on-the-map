<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

require_once 'db_config.php';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

$data = json_decode(file_get_contents('php://input'))->data;
$user = $data->user;


if($data->requestType === "login") {
    $password = encryptPassword($user->password);

    // находим пользователя у которого совпадает email и пароль
    $find_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='$user->login' && `password`='$password'");
    
    $user = null;
    if($find_user->num_rows !== 0) { // если пользователь найден
        $user = mysqli_fetch_array($find_user);

        $token = generateToken();
        $id_user = $user['id_user'];

        $set_token = mysqli_query($link, "UPDATE `users` SET `token`='$token' WHERE `id_user`='$id_user'"); // обновляем токен

        print_r(json_encode(array(
            token => $token,
            name => $user['name'],
            surname => $user['surname'],
            email => $user['email'],
        )));
        
    }
    else {
        echo "false";
    }
    


}

if($data->requestType === "isAuthenticated") {

    if(!$user) {
        echo "false";
        return;
    }

    $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `token`='$user->token' && `email`='$user->email'"); // находим пользователя у которого совпадает токен и email
    
    if($sql->num_rows !== 0) { // если пользователь найден
        echo "true";
    }
    else {
        echo "false";
    }
}


if($data->requestType === "signUp") { // запрос на регистрацию

    if(validate($user)) {

        $encryptPassword = encryptPassword($user->password); // шифруем пароль
        $date_of_registration = date('Y:m:d'); // дата регистрации пользователя
        $token = generateToken();

        $sql = mysqli_query($link, "INSERT INTO users (`name`, `surname`, `login`, `password`, `email`, `token`, `date_of_registration`)
        VALUES ('$user->name', '$user->surname', '$user->login', '$encryptPassword', '$user->email', '$token', '$date_of_registration')");

        if($sql) { // если запрос выполнился успешно
            print_r(json_encode(array(
                token => $token,
                name => $user->name,
                surname => $user->surname,
                email => $user->email,
            )));
        }
    }
    else {
        echo "false";
    }

}



function checkPassword($password, $repassword) { // проверка на совпадение паролей
    if($password === $repassword) return true;
    return false;
}


function validate($user) { // валидация
    if($user->email !== "" && $user->password !== "" && checkPassword($user->password, $user->repassword)) {
        return true;
    }

    return false;
}


function encryptPassword($password) { // шифрование пароля
    return md5($password);
}


function generateToken() { // генерация уникального токена
    return md5(uniqid('', true));
}




?>