<?php
// libraries/Twig.php

class Twig
{
    private $ci;
    private $twig;

    public function __construct()
    {
        // CodeIgniterのインスタンスを取得
        $this->ci =& get_instance();

        // Twigをnew
        $loader = new Twig_Loader_Filesystem(VIEWPATH);
        $this->twig = new Twig_Environment($loader);

        // CodeIgniterのhelper関数をTwigに追加することもできる
        $this->twig->addGlobal('baseUrl', base_url());
        $this->twig->addFunction(new Twig\TwigFunction('setValue', 'set_value'));
        $this->twig->addFunction(new Twig\TwigFunction('formError', 'form_error'));
    }

    // CodeIgniterのoutputにTwigのrenderを渡す
    public function render($template, $data=[])
    {
        $this->ci->output->set_output(
            $this->twig->render($template, $data)
        );
    }
}