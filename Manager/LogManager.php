<?php
class LogManager extends Manager
{

    public function createLogFromPost(DummyJob $dummyJob, $remainingHp, $remainingTime, $currentIlvl = null)
    {

        //On instancie le log.
        $log = new Log([
            "User" => $GLOBALS["app"]->getUserLogged() ,
            "DummyJob" => $dummyJob,
            "MaxHp" => $dummyJob->getMaxHp(),
            "RemainingHp" => $remainingHp,
            "RemainingTime" => $remainingTime,
            "Killed" => 0,
            "CurrentIlvl" => $currentIlvl
        ]);

        //On vérifie si le mannequin est mort.
        if($log->getRemainingHp() == 0)
            $log->setKilled(1);

        //On calcule le nb d'hp descendus.
        $hpDown = $log->getMaxHp() - ($log->getMaxHp() * $log->getRemainingHp() / 100);

        //On calcule le temps passé.
        $time = $log->getDummyJob()->getDummy()->getTime() - $log->getRemainingTime();
        if($time <= 0)
            return null;

        //On calcule le DPS.
        $log->setDps(round($hpDown / $time, 2));

        //On insère le log.
        $this->insertLog($log);

        return $log;

    }

    public function insertLog(Log $log)
    {
        $query = $GLOBALS["app"]->getDb()->prepare("
            INSERT INTO log (Id, User_Id, DummyJob_Id, MaxHp, RemainingHp, RemainingTime, Dps, Killed, CreationDate, CurrentIlvl)
            VALUES (NULL, :user_id, :dummy_job_id, :max_hp, :remaining_hp, :remaining_time, :dps, :killed, CURRENT_TIMESTAMP, :current_ilvl);
        ");
        $query->bindValue("user_id", $this->getIdOrNull($log->getUser()));
        $query->bindValue("dummy_job_id", $log->getDummyJob()->getId());
        $query->bindValue("max_hp", $log->getMaxHp());
        $query->bindValue("remaining_hp", $log->getRemainingHp());
        $query->bindValue("remaining_time", $log->getRemainingTime());
        $query->bindValue("dps", $log->getDps());
        $query->bindValue("killed", $log->getKilled());
        $query->bindValue("current_ilvl", $log->getCurrentIlvl());
        $query->execute();
        $log->setId($GLOBALS["app"]->getDb()->lastInsertId());

    }

}