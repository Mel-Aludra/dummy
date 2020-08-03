<?php
class LogsView extends View
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
            <h1>Personal logs</h1>
        </div>
        <div class="contentBloc">
            <?php
            /** @var Log $log */
            foreach($this->getData()["Logs"] as $log) {
                ?>
                <div class="itemBloc">
                    <div class="body">
                        <div class="labelContainer">
                            <p>
                                <img draggable="false" src="Ressources/img/Icons/<?php echo $log->getDummyJob()->getJob()->getIcon(); ?>" />
                                <span class="separation"></span>
                                <span class="major"><?php echo $log->getDummyJob()->getDummy()->getName() ?></span>
                                <span class="separation">-</span>
                                <span class="major"><?php echo $log->getDps() ." dps"; ?></span>
                                <?php
                                if($log->getCurrentIlvl() !== null) {
                                    ?>
                                    <span class="separation">-</span>
                                    <span class="minor">ilvl: <?php echo $log->getCurrentIlvl(); ?></span>
                                    <?php
                                }
                                ?>
                                <span class="separation">-</span>
                                <span class="minor"><?php echo $log->getCreationDate(); ?></span>
                                <span class="separation">-</span>
                                <span class="major"><a href="?page=Log&LogId=<?php echo $log->getId(); ?>">See log</a></span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}