<?php
/*
   +----------------------------------------------------------------------+
   | Sobak User System 2                                                  |
   +----------------------------------------------------------------------+
   | www.forumweb.pl/a/b/487677                                           |
   +----------------------------------------------------------------------+
   | Ten plik jest częścią skryptu Sobak User System 2 <sobak.pl>         |
   | Integrowanie w treść tego komentarza stanowi naruszenie zasad, na    |
   | których udostępniono kod.                                            |
   +----------------------------------------------------------------------+
*/

class User {
    /** @var object Przechowuje obiekt klasy MySQLi **/
    protected $db;

    /**
     * Najbanalniejsza implementacja Dependency Injection, co by uniknąć globali
     *
     * @param object Obiekt klasy MySQLi
     * @return void
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Zwraca tablicę ze wszystkimi danymi o użytkowniku.
     *
     * @param int $userID ID określonego użytkownika; jeżeli pominięte to obecnie zalogowany
     * @return array
     */
    public function data($userID = null)
    {
        try {
            if ($userID === null) {
                $userID = $_SESSION['user_id'];
            }

            $userID = intval($userID);

            $dataU = $this->db->prepare("SELECT * FROM users WHERE id = :userID");
            $dataU->bindValue(':userID', $userID, PDO::PARAM_INT);
            $dataU->execute();
            return $dataU->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo "dataUser Error: " . $e->getMessage();
            die();
        }
    }

    /**
     * Sprawdza czy użytkownik jest zalogowany
     *
     * @return bool
     */
    public function check()
    {
        return isset($_SESSION['user_id']);
    }


    /**
     * Sprawdza czy istnieje użytkownik o podanych danych
     *
     * @param string $login Podany login użytkownika
     * @param string $password Podane hasło użytkownika (plaintext)
     * @return bool|int Zwraca ID zalogowanego użytkownika lub false
     */
    public function auth($login, $password)
    {
        try {
            $tmp = $this->db->prepare("SELECT id, password FROM users WHERE login = :login");
            $tmp->bindValue(':login', $login, PDO::PARAM_STR);
            $tmp->execute();

            if (!$tmp->rowCount()) {
                return false;
            }

            $userData = $tmp->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $userData['password'])) {
                return $userData['id'];
            } else {
                return false;
            }
        }
        catch (PDOException $e) {
            echo "auth Error: " . $e->getMessage();
            die();
        }
    }
    
    
    /*
        Sprawdza czy użytkownik o podanym loginie istnieje.
    */
    public function confirm($login)
    {
        try {
            $tmp = $this->db->prepare("SELECT id FROM users WHERE login = :login");
            $tmp->bindValue(':login', $login, PDO::PARAM_STR);
            $tmp->execute();
            $active = $tmp->fetch();

            if (!$tmp->rowCount()) {
                return false;
            }

            return true;
        }
        catch (PDOException $e) {
            echo "confirm Error: " . $e->getMessage();
            die();
        }
    }
    
    public function isActive($login){
        try {
            $tmp = $this->db->prepare("SELECT active FROM users WHERE login = :login");
            $tmp->bindValue(':login', $login, PDO::PARAM_STR);
            $tmp->execute();

            $active = $tmp->fetch();
            if($active['active'] == 0){
                return false;
            }
            else
                return true;
        }
        catch (PDOException $e) {
            echo "isActive Error: " . $e->getMessage();
            die();
        }
    }
    
    public function flagCheck($login){
        try {
            $tmp = $this->db->prepare("SELECT flag FROM users WHERE login = :login");
            $tmp->bindValue(':login', $login, PDO::PARAM_STR);
            $tmp->execute();

            $flag = $tmp->fetch();
            if($flag['flag'] == 0){
                return false;
            }
            else
                return true;
        }
        catch (PDOException $e) {
            echo "flagCheck Error: " . $e->getMessage();
            die();
        }
    }
}
?>