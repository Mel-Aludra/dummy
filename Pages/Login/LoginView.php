<?php
class LoginView extends View
{
    public function getView(){
        $this->beginPage();
        $this->body();
        $this->endPage();
    }

    public function body()
    {
        ?>
        <div class="spacingBloc"></div>
        <div class="titleAndDescriptionBloc">
            <h1>Login</h1>
            <p>Your Morbol Dummy Challenge account allows you to keep the last 50 calculations.</p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">

            <?php
            if(isset($this->getData()["PostReturn"]) && $this->getData()["PostReturn"][0] === true) {
                ?>
                <p>Hello, <?php echo $this->getData()["PostReturn"][1]->getLogin(); ?>!</p>
                <p>What do you want to do?</p>
                <div class="actionsBloc">
                    <a href="?page=Fight">Calculate DPS</a>
                    <a href="?page=DummyList">Dummies list</a>
                    <a href="?page=Logs">My logs</a>
                </div>
                <?php
            }
            else {
                if(isset($this->getData()["PostReturn"]) && $this->getData()["PostReturn"][0] === false) {
                    ?>
                    <p class="error"><?php echo $this->getData()["PostReturn"][1]; ?></p>
                    <?php
                }
                ?>
                <form class="centerForm" method="post" action="">
                    <div class="formElement">
                        <input required="required" type="text" name="login[login]" />
                        <label>User Name</label>
                    </div>
                    <div class="formElement">
                        <input required="required" type="password" name="login[password]" />
                        <label>Password</label>
                    </div>
                    <div class="formElement">
                        <input value="Log in" type="submit" />
                    </div>
                </form>
                <?php
            }
            ?>

        </div>
    <?php
    }

}