<?php
class LogoutController extends Controller
{
    public function __construct()
    {
        $GLOBALS["app"]->destroySession();
        $pageView = new LogoutView($this->getData());
        $pageView->getView();
    }

}