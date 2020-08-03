<?php
class LoginController extends Controller
{
    public function __construct()
    {

        if(isset($_POST["login"])) {
            $this->addData("PostReturn", $this->postLogin($_POST["login"]));
        }

        $pageView = new LoginView($this->getData());
        $pageView->getView();
    }

    public function postLogin($post)
    {

        if(!isset($post["login"]) || !isset($post["password"]))
            return [false, "Don't play dumb, please."];

        if(empty($post["login"]) && empty($post["login"]))
            return [false, "Don't play dumb, please. Kek."];

        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($post["login"], $post["password"]);
        if($user === null)
            return [false, "Wrong user name or password."];

        $GLOBALS["app"]->setUserLogged($user);
        $_SESSION["userId"] = $user->getId();
        return [true, $user];

    }

}