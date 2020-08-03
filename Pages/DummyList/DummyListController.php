<?php
class DummyListController extends Controller
{
    public function __construct()
    {
        $dummyManager = new DummyManager();
        $this->addData("Dummies", $dummyManager->sortDummiesByExpansionThenByDifficulty($dummyManager->findAllDummiesSortedByReversePatchesAndAscendingFloors()));

        //On instancie la vue
        $pageView = new DummyListView($this->getData());
        $pageView->getView();
    }
}