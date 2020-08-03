<?php
class LogView extends View
{
    public function getView()
    {
        $this->beginPage();
        $this->body();
        $this->getJavascript();
        $this->endPage();
    }

    public function body()
    {
        if(is_null($this->getData()["Log"]))
            $this->getErrorView();
        else
            $this->getSuccessView();
    }

    public function getSuccessView()
    {
        /** @var Log $log */
        $log = $this->getData()["Log"];
        ?>
        <div class="spacingBloc"></div>
        <div class="titleAndDescriptionBloc">
            <h1>Log</h1>
            <p><?php echo $log->getDummyJob()->getDummy()->getName(); ?></p>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">
            <div class="logContainer">
                <div class="fightResultSummary">
                    <h2 style="margin-top: 22px"><?php
                        if($log->getUser() !== null)
                            echo $log->getUser()->getLogin() . " (" . $log->getDummyJob()->getJob()->getName() . ")";
                        else
                            echo $log->getDummyJob()->getJob()->getName();
                        ?>
                        vs <?php echo $log->getDummyJob()->getDummy()->getName() ?></h2>
                    <div class="dpsDisplayContainer">
                        <img draggable="false" src="Ressources/img/Icons/<?php echo $log->getDummyJob()->getJob()->getIcon(); ?>" />
                        <span class="dpsBigResult"><?php echo $log->getDps() ?> dps</span>
                    </div>
                    <!--      Icon status dummy ?              -->
                    <div class="dummyStatusContainer">

                        <?php
                        if($log->getKilled() === 0)
                            $this->getIcon("DummyNotKilled");
                        else
                            $this->getIcon("DummyKilled");
                        ?>
                    </div>
                </div>

                <table>
                    <tr>
                        <th>Dummy status</th>
                        <td><?php

                            if($log->getKilled() === 0)
                                echo "Not killed";
                            else
                                echo "Killed";
                            ?></td>
                    </tr>
                    <tr>
                        <th>Player ilvl</th>
                        <td><?php
                            if($log->getCurrentIlvl() !== null)
                                echo $log->getCurrentIlvl();
                            else
                                echo "Not specified";
                            ?></td>
                    </tr>
                    <tr>
                        <th>Maximum dummy HP</th>
                        <td><?php echo $log->getMaxHp() ?> HP</td>
                    </tr>
                    <tr>
                        <th>Remaining HP</th>
                        <td><?php echo $log->getRemainingHp() ?>%</td>
                    </tr>
                    <tr>
                        <th>Remaining time</th>
                        <td><?php echo $log->getRemainingTime() ?>s</td>
                    </tr>
                    <tr class="clickTr" onclick="copyLogLink()">
                        <th style="border-bottom: none">Permalink</th>
                        <td style="border-bottom: none">
                            <span>Click to copy:</span>
                            <input style="text-overflow: ellipsis" type="text" value="<?php echo Tools::getAbsolutePath() . "?page=Log&LogId=" . $log->getId(); ?>" id="buttonToCopy" />
                        </td>
                    </tr>
                </table>
                <p>

                </p>

            </div>
        </div>

        <div class="spacingBloc"></div>
        <div class="contentBloc ghost">
            <h2>Do something else:</h2>
            <div class="actionsBloc">
                <a href="?page=Fight">Calculate DPS</a>
                <a href="?page=DummyList">Dummies list</a>
                <?php
                if($GLOBALS['app']->getUserLogged() !== null) {
                    ?>
                    <a href="?page=Logs">Your logs</a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    public function getErrorView()
    {
        ?>
        <div class="spacingBloc"></div>
        <div class="titleAndDescriptionBloc">
            <h1>Log not found</h1>
        </div>
        <div class="spacingBloc"></div>
        <div class="contentBloc">
            <h2>Try again:</h2>
            <div class="actionsBloc">
                <a href="?page=Fight">Calculate DPS</a>
                <a href="?page=DummyList">Dummies list</a>
            </div>
        </div>
        <?php
    }

    public function getJavascript()
    {
        ?>
        <script src="<?php echo Tools::getAbsolutePath(); ?>/Pages/Log/Log.js"></script>
        <?php
    }

}