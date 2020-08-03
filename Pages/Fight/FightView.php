<?php
class FightView extends View
{
    public function getView(){
        $this->beginPage();
        $this->body();
        $this->getJavascript();
        $this->endPage();
    }

    public function body()
    {
        ?>
        <div class="spacingBloc"></div>
        <div class="titleAndDescriptionBloc">
            <h1>Calculate DPS</h1>
            <p>Choose a job, a fight and put the remaining % HP or seconds.</p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">

            <?php
            if(isset($this->getData()["PostReturn"]) && $this->getData()["PostReturn"][0] === false) {
                ?>
                <p class="error" style="margin-bottom:0"><?php echo $this->getData()["PostReturn"][1]; ?></p>
                <?php
            }
            ?>

            <form class="consecutiveBlocsForm" action="" method="post">

                <!-- Choix du job -->
                <div class="all">
                    <h2>Choose your job:</h2>
                    <div class="jobsSelection">
                        <?php
                        foreach($this->getData()["Jobs"] as $roleName => $jobs) {
                            ?>
                            <div class="roleContainer">
                                <h3><?php echo $roleName; ?></h3>
                                <div class="jobsContainer">
                                    <?php
                                    /** @var Job $job */
                                    foreach($jobs as $job) {
                                        ?>
                                        <img draggable="false" id="iconJobId<?php echo $job->getId(); ?>" onclick="selectJob(this, <?php echo $job->getId(); ?>)" src="Ressources/img/Icons/<?php echo $job->getIcon(); ?>" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="hidden" id="jobIdInput" name="fight[jobId]" value="null" />
                </div>

                <!-- Choix du combat -->
                <div class="tier">
                    <h2>Choose your fight:</h2>

                    <div class="formElement">
                        <select id="dummySelection" name="fight[dummyId]" oninput="triggerAvailableJobsBySelectTrigger(this)">
                            <option class="nativeDisabled" value="null" hidden="hidden">Select fight</option>
                            <?php
                            foreach($this->getData()["Dummies"] as $expansionKey => $expansion) {
                                foreach($expansion as $raidTierKey => $raidTier) {
                                    ?>
                                    <optgroup label="<?php echo $expansionKey ?> - <?php echo $raidTierKey ?>">
                                        <?php
                                        /** @var Dummy $dummy */
                                        foreach($raidTier as $dummy) {
                                            if(count($dummy->getDummyJob())> 0) {
                                                ?>
                                                <option id="dummyId<?php echo $dummy->getId(); ?>" value="<?php echo $dummy->getId(); ?>"><?php echo $dummy->getName(); ?></option>
                                            <?php
                                            }
                                            else {
                                                ?>
                                                <option class="nativeDisabled" disabled="disabled"><?php echo $dummy->getName(); ?> (not available yet)</option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </optgroup>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Choix des options (combat) -->
                <div class="twoTiers">
                    <h2>Battle results:</h2>
                    <div class="genericFlexRowHighRes">
                        <div class="formElement small">
                            <input name="fight[remainingHp]" type="number" min="0" step="0.1" value="" />
                            <label>Remaining HP %</label>
                        </div>
                        <div class="formElement small">
                            <input name="fight[remainingTime]" type="number" min="0" value="" />
                            <label>Remaining seconds</label>
                        </div>
                    </div>
                </div>

                <!-- Choix des options (joueur) -->
                <div class="tier">
                    <h2>Player informations:</h2>
                    <div class="genericFlexRowHighRes">
                        <div class="formElement">
                            <input name="fight[currentIlvl]" type="number" min="0" value="" />
                            <label>Current ilvl (optional)</label>
                        </div>
                    </div>
                </div>

                <div class="all genericFlexRowHighRes genericFlexRowHighRes_Center">
                    <input value="Calculate" type="submit"/>
                </div>
            </form>

        </div>
    <?php
    }

    public function getJavascript()
    {
        ?>
        <script src="<?php echo Tools::getCurrentPagePath(); ?>Fight.js"></script>
        <script>
            var availableJobsByDummy = <?php echo json_encode($this->getData()["AvailableJobsByDummy"]); ?>;
            var availableDummiesByJob = <?php echo json_encode($this->getData()["AvailableDummiesByJob"]); ?>;
        </script>
        <?php
    }
}