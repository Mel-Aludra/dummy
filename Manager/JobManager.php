<?php
class JobManager extends Manager
{

    public function sortJobsByRole($jobs)
    {

        $roles = [];
        /** @var Job $job */
        foreach($jobs as $job) {
            $roles[$job->getRole()->getName()][] = $job;
        }
        return $roles;
    }

}