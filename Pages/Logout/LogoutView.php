<?php
class LogoutView extends View
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
            <h1>Logged out</h1>
            <p>You're now logged out.</p>
        </div>
        <?php
    }
}