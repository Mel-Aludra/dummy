<?php
class ErrorController extends Controller
{
    public function __construct($error, $hardError = false)
    {
        $pageView = new ErrorView();
        if($hardError)
            $pageView->hardErrorView();
        else
            $pageView->getView($error);
        die();
    }
}