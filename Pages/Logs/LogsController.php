<?php
class LogsController extends Controller
{
    public function __construct()
    {
        if($GLOBALS["app"]->getUserLogged() === null) {
            new ErrorController("Error: you're not logged.");
        }
        $this->addData("Logs", $GLOBALS["app"]->getUserLogged()->getLog());
        $pageView = new LogsView($this->getData());
        $pageView->getView();
    }
}