<?php
class DummyJobManager extends Manager
{
    public function findDummyJob($dummyId, $jobId)
    {
        $query = $GLOBALS['app']->getDb()->prepare("
            SELECT * FROM dummy_job
            WHERE Dummy_Id = :dummy_id
            AND Job_Id = :job_id
            LIMIT 1
        ");
        $query->bindValue(":dummy_id", $dummyId);
        $query->bindValue(":job_id", $jobId);
        $query->execute();

        $result = $query->fetch();
        if($result === false)
            return null;
        return new DummyJob($result);
    }

    public function getAvailableJobsByDummyMapping($dummyJobs)
    {

        $results = [];

        /** @var DummyJob $dummyJob */
        foreach($dummyJobs as $dummyJob) {
            $results[$dummyJob->getDummy()->getId()][] = $dummyJob->getJob()->getId();
        }

        return $results;

    }

    public function getAvailableDummiesByJobMapping($dummyJobs)
    {

        $results = [];

        /** @var DummyJob $dummyJob */
        foreach($dummyJobs as $dummyJob) {
            $results[$dummyJob->getJob()->getId()][] = $dummyJob->getDummy()->getId();
        }

        return $results;

    }

}