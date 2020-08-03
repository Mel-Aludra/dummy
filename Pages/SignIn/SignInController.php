<?php
class SignInController extends Controller
{
    public function __construct()
    {
        //On vérifie s'il y a un post.
        if(isset($_POST["signIn"])) {
            $this->addData("PostReturn", $this->postUser($_POST["signIn"]));
        }

        //On instancie la vue
        $pageView = new SignInView($this->getData());
        $pageView->getView();
    }

    public function postUser($post)
    {
        //On vérifie l'intégrité des données envoyées
        if(!isset($post["login"]) || !isset($post["password"]) || !isset($post["confirmPassword"]))
            return [false, "System error. Don't touch the DOM, please. *wink*"];

        //On vérifie que les deux passwords soient les mêmes
        if($post["password"] !== $post["confirmPassword"])
            return [false, "Confirm Password needs to be the same as the Password."];

        //On vérifie que l'email est valide
        if (!empty($post["email"]) && !filter_var($post["email"], FILTER_VALIDATE_EMAIL))
            return [false, "The email adress is invalid."];

        //Autres vérifications (longueur du username et du password
        if (strlen($post['login']) < 3 || strlen($post['login']) > 50)
            return [false, "User name too short or too long."];

        if (strlen($post['password']) < 6 || strlen($post['password']) > 50)
            return [false, "Password too short or too long."];

        //Création d'un user
        $userManager = new UserManager();
        if($userManager->isUserExistByLogin($post['login']) || (!empty($post['email']) && $userManager->isUserExistByEmail($post['email'])))
            return [false, "Login or Email already exist."];

        $user = $userManager->createUserFromPost($post["login"],$post["email"],$post["password"]);
        $GLOBALS["app"]->setUserLogged($user);
        $_SESSION["userId"] = $user->getId();
        return [true, "Welcome, " . $user->getLogin()];
    }
}