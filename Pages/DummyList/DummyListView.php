<?php
class DummyListView extends View
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
            <h1>All dummies</h1>
            <p>Check HP and required DPS of dummies.</p>
        </div>

        <div class="contentBloc">
        <?php
        foreach($this->getData()["Dummies"] as $expansionKey=>$expansion) {
            ?>
            <h1><?php echo $expansionKey ?></h1>
            <?php
            foreach($expansion as $raidTierKey=>$raidTier) {
                ?>
                <h2><?php echo $raidTierKey ?></h2>
                <?php
                /** @var Dummy $dummy */
                foreach($raidTier as $dummy) {
                    ?>
                    <div class="itemBloc">
                        <div class="header">
                            <p style="margin-bottom:0"><?php echo $dummy->getName(); ?></p>
                        </div>
                        <div class="body">
                            <div class="labelContainer">
                                <?php
                                if(count($dummy->getDummyJob()) === 0) {
                                    ?>
                                    <p>Sorry, we have no data for this dummy.</p>
                                    <?php
                                }
                                /** @var DummyJob $dummyJob */
                                foreach($dummy->getDummyJob() as $dummyJob) {
                                    ?>
                                    <p>
                                        <img draggable="false" src="Ressources/img/Icons/<?php echo $dummyJob->getJob()->getIcon(); ?>" />
                                        <span class="separation"></span>
                                        <span class="major"><?php echo $dummyJob->getJob()->getName() . " - " . $dummyJob->getMaxHp() . " HP"; ?></span>
                                        <span class="separation">-</span>
                                        <span class="minor"><?php echo "Dps required: <strong>" . $dummyJob->getDpsRequired() . "</strong>"; ?></span>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                }

            }
        }
        ?>

        </div>

        <?php
    }
}