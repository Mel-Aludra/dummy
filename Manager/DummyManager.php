<?php
class DummyManager extends Manager
{
    public function sortDummiesByExpansionAndDifficulty($dummies)
    {
        $raidTiers = [];
        /** @var Dummy $dummy */
        foreach($dummies as $dummy) {
            $raidTiers[$dummy->getRaidTier()->getExtensionName() . " - " . $dummy->getRaidTier()->getName()][] = $dummy;
        }
        return $raidTiers;
    }

    public  function sortDummiesByExpansionThenByDifficulty($dummies)
    {
        $expansions = [
            "Shadowbringers" => [],
            "Stormblood" => []
        ];
        /** @var Dummy $dummy */
        foreach($dummies as $dummy) {
            $expansions[$dummy->getRaidTier()->getExtensionName()][$dummy->getRaidTier()->getName()][] = $dummy;
        }
        return $expansions;
    }

    public function findAllDummiesSortedByReversePatchesAndAscendingFloors()
    {
        $entities = [];
        $q = $GLOBALS["app"]->getDb()->query("
            SELECT d.Id AS dummyId FROM dummy d JOIN raid_tier rt ON rt.Id = d.RaidTier_Id ORDER BY Patch DESC, Floor ASC
        ");
        while($q_result = $q->fetch()) {
            $entities[] = $this->find($q_result["dummyId"]);
        }
        return $entities;
    }

}