<?php
declare(strict_types=1);

/**
 * @property DrinkModel $drinkModel
 * @property CI_Config  $config
 */
class SearchController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->config('data');
    }

    public function index($kind): void
    {
        $drinks = $this->config->item('drinks');
        $classifiedDrinks = $this->classifyInKinds($drinks);

        $assign = [
            'drinks' => $classifiedDrinks[$kind],
            'kind' => $kind,
        ];

        $this->twig->render('/templates/search.html.twig', $assign);
    }

    private function classifyInKinds($drinks)
    {
        $kinds = $this->config->item('kinds');

        $classifiedDrinkData = [];

        foreach ($kinds as $kind) {
            $classifiedDrinkData[$kind] = array_filter($drinks, static function ($drink) use ($kind) {
                return $drink['kind'] === $kind;
            });
        }

        return $classifiedDrinkData;
    }

}