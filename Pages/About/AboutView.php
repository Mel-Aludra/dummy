<?php
class AboutView extends View
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
            <h1>About</h1>
            <p>Why the Morbol Dummy Challenge web site?</p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">
            <h2>For PS4 friends</h2>
            <p>Stone Sky Sea is no more updated. And friends in our roster play on PS4. We'll try to update the database for everyone.</p>
            <div class="separator"></div>
            <h2>Authors: Lys and Mel</h2>
            <p>Feel free to ask for upgrades or propose data if we don't update everything. You can contact us <a href="mailto:contact@morbol.fr">contact@morbol.fr</a>.</p>
        </div>
        <?php
    }

}