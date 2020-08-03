<?php
class HomeView extends View
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
            <h1>Welcome !</h1>
            <p>Morbol Dummy Challenge is a theoric DPS calculation with Stone, Sky, Sea dummies.</p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">
            <h2>You play on PS4 or you don't own ACT ?</h2>
            <p>Enjoy the Morbol Dummy Challenge.</p>
            <p>Choose a <strong>Stone, Sky Sea</strong> dummy and a job and <strong>fight it</strong>. Then <strong>put the remaining % HPs or the remaining time</strong> so that we can calculate your dps.</p>
            <div class="separator"></div>
            <h2>Save your score</h2>
            <p>Create an account to save your logs and access your last 50 calculations on Morbol Dummy Challenge.</p>
            <div class="separator"></div>
            <div class="actionsBloc">
                <a href="?page=Login">Log in</a>
                <a href="?page=Fight">Calculate DPS</a>
                <a href="?page=DummyList">Dummies list</a>
            </div>
        </div>
        <?php
    }

}