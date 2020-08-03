<?php
class AboutController extends Controller
{
    public function __construct()
    {
        $pageView = new AboutView();
        $pageView->getView();
    }
}