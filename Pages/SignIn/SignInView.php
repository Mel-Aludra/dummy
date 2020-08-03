<?php
class SignInView extends View
{
    public function getView()
    {
        $this->beginPage();
        $this->body();
        $this->endPage();
    }

    public function body()
    {
        ?>
        <div class="spacingBloc"></div>
        <div class="titleAndDescriptionBloc">
            <h1>Sign in</h1>
            <p>Create an account to save your logs and access your last 50 calculations on Morbol Dummy Challenge.</p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">
            <?php
            if(isset($this->getData()["PostReturn"]) && $this->getData()["PostReturn"][0] === true) {
                ?>
                <p>Your account is created!</p>
                <div class="actionsBloc">
                    <a href="?page=Fight">Calculate DPS</a>
                    <a href="?page=DummyList">Dummies list</a>
                </div>
                <?php
            }
            else {
                if(isset($this->getData()["PostReturn"]) && $this->getData()["PostReturn"][0] === false) {
                    ?>
                    <p class="error">An error occurred while creating the account.</p>
                    <?php
                }
                ?>
                <form class="centerForm" action="" method="post">
                    <div class="formElement">
                        <input required="required" name="signIn[login]" type="text" value=""/>
                        <label>User Name</label>
                    </div>
                    <div class="formElement">
                        <input name="signIn[email]" type="email" value=""/>
                        <label>Email (optional)</label>
                    </div>
                    <div class="formElement">
                        <input required="required" name="signIn[password]" type="password" value=""/>
                        <label>Password</label>
                    </div>
                    <div class="formElement">
                        <input required="required" name="signIn[confirmPassword]" type="password" value=""/>
                        <label>Confirm Password</label>
                    </div>
                    <div class="formElement">
                        <input value="Create account" type="submit" />
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
        <?php
    }
}