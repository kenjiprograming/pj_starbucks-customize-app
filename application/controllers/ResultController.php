<?php
declare(strict_types=1);

/**
 * @property Twig       $twig
 * @property CI_Input   $input
 * @property CI_Config  $config
 */
class ResultController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->config('data');
    }

    public function index(): void
    {
        $drink_customize_set = $this->config->item('drink_customize_set');
        $name = $_POST['name'];
        $price = $_POST['price'];
        $imageUrl = $_POST['imageUrl'];
        $selectedPrice = $_POST['selectedPrice'];

        $assign = [
            'sets' => $drink_customize_set[$name],
            'name' => $name,
            'price' => $price,
            'selectedPrice' => $selectedPrice,
            'imageUrl' => $imageUrl,
        ];

        echo '<pre>';
        print_r($assign);
        exit();

        $this->twig->render('/templates/result.html.twig', $assign);
    }

}