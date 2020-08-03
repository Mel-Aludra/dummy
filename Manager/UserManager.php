<?php
class UserManager extends Manager
{
    public function createUserFromPost($login, $email, $password)
    {

        $user = new User([
            "Login" => $login,
            "Email" => $email,
            "Password" => $this->getEncryptedPassword($password)
        ]);

        return $this->insertUser($user);
    }

    public function insertUser(User $user)
    {
        $query = $GLOBALS["app"]->getDb()->prepare("
        INSERT INTO user (Id, Login, Email, Password)
        VALUES (NULL, :login, :email, :password);
        ");
        $query->bindValue("login", $user->getLogin());
        $query->bindValue("email", $user->getEmail());
        $query->bindValue("password", $user->getPassword());
        $query->execute();
        $user->setId($GLOBALS["app"]->getDb()->lastInsertId());
        return $user;
    }

    public function getEncryptedPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
    }

    public function isUserExistByLogin($login)
    {
        $query = $GLOBALS['app']->getDb()->prepare("
            SELECT COUNT(*) FROM user
            WHERE Login = :login
        ");
        $query->bindValue("login", $login);
        $query->execute();

        if($query->fetch()[0] > 0)
            return true;

        return false;
    }

    public function isUserExistByEmail($email)
    {
        $query = $GLOBALS['app']->getDb()->prepare("
            SELECT COUNT(*) FROM user
            WHERE Email = :email
        ");
        $query->bindValue("email", $email);
        $query->execute();

        if($query->fetch()[0] > 0)
            return true;

        return false;
    }

    public function getUserByLogin($login, $password)
    {
        $query = $GLOBALS['app']->getDb()->prepare("
            SELECT * FROM user
            WHERE Login = :login
        ");
        $query->bindValue("login", $login);
        $query->execute();
        $result = $query->fetch();
        if($result !== false) {
            $user = new User($result);
            if(password_verify($password, $user->getPassword())) {
                return $user;
            }
        }
        return null;
    }

}