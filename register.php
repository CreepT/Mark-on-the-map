<?
    header("Content-Type: text/html; charset=utf-8");
    
    require_once 'db_config.php';
    require_once 'auth.php';

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
    mysqli_set_charset($link, "utf8");

    $user = json_decode(file_get_contents('php://input'))->data;


    if(validate($user)) {

        $encryptPassword = encryptPassword($user->password); // шифруем пароль
        $date_of_registration = date('Y:m:d'); // дата регистрации пользователя

        $sql = mysqli_query($link, "INSERT INTO users (`name`, `surname`, `login`, `password`, `email`, `date_of_registration`)
        VALUES ('$user->name', '$user->surname', '$user->login', '$encryptPassword', '$user->email', '$date_of_registration')");

        if($sql) { // если запрос выполнился успешно
            print_r(array(
                token => generateToken(),
                name => $user->name,
                surname => $user->surname,
                email => $user->email,
            ));
        }
    }
    else {
        echo "false";
    }

    
      
      
?>