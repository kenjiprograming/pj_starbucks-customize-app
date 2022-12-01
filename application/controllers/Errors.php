<?php

/**
 * @property $twig
 */
class Errors extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error_404(): void
    {
        $this->twig->render('/errors/404.html.twig');
    }

}