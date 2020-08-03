<?php
class ErrorView extends View
{
    public function getView($error){
        $this->beginPage();
        $this->body($error);
        $this->endPage();
    }

    public function body($error)
    {
        ?>
        <div class="spacingBloc"></div>
        <div class="titleAndDescriptionBloc">
            <h1>Error</h1>
            <p><?php echo $error; ?></p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">
            <h2>Try something else:</h2>
            <div class="actionsBloc">
                <a href="?page=Login">Log in</a>
                <a href="?page=Fight">Calculate DPS</a>
                <a href="?page=DummyList">Dummies list</a>
            </div>
        </div>
    <?php
    }

    public function hardErrorView()
    {
        ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <link rel="stylesheet" href="Ressources/CSS/global.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/menu.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/form.css" xmlns="http://www.w3.org/1999/html">
                    <link rel="stylesheet" href="Ressources/CSS/style.css" xmlns="http://www.w3.org/1999/html">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <div class="menuContainer">
                        <div class="siteTitleBloc">
                            <p><a href="?page=home">Staune Scaille Scie</a></p>
                            <div onclick="toggleMenu(this)" class="burgerMenu lowResShow">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="menuLinksContainer lowResHide">
                        </div>
                    </div>
                    <div class="globalContainer">
                        <div class="spacingBloc"></div>
                        <div class="titleAndDescriptionBloc">
                            <h1>Unavailable</h1>
                        </div>
                    </div>
                <script src="Scripts/DomFunctions.js"></script>
                </body>
            </html>
        <?php
    }

}