<?php
abstract class View
{

    protected $data;

    public function __construct($data = null) {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function beginPage()
    {
        ?>
        <!DOCTYPE html>
            <html>
                <head>
                    <link rel="stylesheet" href="Ressources/CSS/global.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/menu.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/form.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/style.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/logs.css" xmlns="http://www.w3.org/1999/html">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>

                    <div class="menuContainer">

                        <div class="siteTitleBloc">
                            <p><a href="?page=Home">Morbol Dummy Challenge</a></p>
                            <div onclick="toggleMenu(this)" class="burgerMenu lowResShow">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="menuLinksContainer lowResHide">
                            <?php $this->menu(); ?>
                        </div>

                    </div>

                    <div class="globalContainer">
        <?php
    }

    public function endPage()
    {
        ?>
                    </div>
                <script src="Scripts/DomFunctions.js"></script>
                </body>
            </html>
        <?php
    }

    public function menu()
    {
        ?>
        <div class="menuLinksSubContainer">
            <?php
            $this->getMenuButton("Fight", "Calculate");
            $this->getMenuButton("DummyList", "Dummies list");
            $this->getMenuButton("About", "About");
            if($GLOBALS['app']->getUserLogged() !== null) {
                $this->getMenuButton("Logs", "Logs (" . $GLOBALS['app']->getUserLogged()->getLogin() . ")");
            }
            ?>
        </div>
        <div class="menuLinksSubContainer menuLinksRightSide">
            <?php
            if($GLOBALS['app']->getUserLogged() !== null) {
                $this->getMenuButton("Logout", "Logout");
            }
            else {
                $this->getMenuButton("SignIn", "Sign Up");
                $this->getMenuButton("Login", "Log in");
            }
            ?>
        </div>
        <?php
    }

    public function getMenuButton($pageName, $linkName)
    {
        $isCurrentPage = false;
        if ($GLOBALS["app"]->currentPage === $pageName)
            $isCurrentPage = true;
        ?>
        <a
            href="?page=<?php echo $pageName; ?>"
            class="<?php if($isCurrentPage) { echo "activeButton"; } ?>"
        >
            <?php $this->getIcon($pageName); ?>
            <span><?php echo $linkName ?></span>
        </a>
        <?php

    }

    public function getIcon($iconName)
    {
        switch($iconName) {
            case "Login":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M11 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zM5 18c.2-.63 2.57-1.68 4.96-1.94l2.04-2c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-2-2H5zm15.6-5.5l-5.13 5.17-2.07-2.08L12 17l3.47 3.5L22 13.91z"/></svg>
                <?php
                break;
            case "DummyList":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M2 20h20v-4H2v4zm2-3h2v2H4v-2zM2 4v4h20V4H2zm4 3H4V5h2v2zm-4 7h20v-4H2v4zm2-3h2v2H4v-2z"/></svg>                <?php
                break;
            case "Fight":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M5.54 8.46L2 12l3.54 3.54 1.76-1.77L5.54 12l1.76-1.77zm6.46 10l-1.77-1.76-1.77 1.76L12 22l3.54-3.54-1.77-1.76zm6.46-10l-1.76 1.77L18.46 12l-1.76 1.77 1.76 1.77L22 12zm-10-2.92l1.77 1.76L12 5.54l1.77 1.76 1.77-1.76L12 2z"/><circle cx="12" cy="12" r="3"/></svg>
                <?php
                break;
            case "Logs":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12zM10 9h8v2h-8zm0 3h4v2h-4zm0-6h8v2h-8z"/></svg>
                <?php
                break;
            case "SignIn":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm0 8c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H9zm-3-3v-3h3v-2H6V7H4v3H1v2h3v3z"/></svg>
                <?php
                break;
            case "About":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>                <?php
                break;
            case "Logout":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path opacity=".87" fill="none" d="M0 0h24v24H0V0z"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.59-13L12 10.59 8.41 7 7 8.41 10.59 12 7 15.59 8.41 17 12 13.41 15.59 17 17 15.59 13.41 12 17 8.41z"/></svg>
                <?php
                break;
            case "DummyKilled":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z"/></svg>
                <?php
                break;
            case "DummyNotKilled":
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M14.59 8L12 10.59 9.41 8 8 9.41 10.59 12 8 14.59 9.41 16 12 13.41 14.59 16 16 14.59 13.41 12 16 9.41 14.59 8zM12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                <?php
                break;
        }
    }

}