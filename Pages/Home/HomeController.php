<?php
class HomeController extends Controller
{
    public function __construct()
    {
        $pageView = new HomeView();
        $pageView->getView();
    }
}