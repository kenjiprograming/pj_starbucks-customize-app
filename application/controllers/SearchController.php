<?php
declare(strict_types=1);

/**
 * @property $twig
 */
class SearchController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($drink_name): void
    {
        $this->twig->render('/templates/search.html.twig');
    }

}