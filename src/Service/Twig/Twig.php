<?php

namespace Lenvendo\Canvas\Service\Twig;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * @author Vehsamrak
 */
class Twig
{

    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(VIEW_DIRECTORY);
        $this->twig = new Twig_Environment($loader);
    }

    public function render(string $name, array $parameters = []): string
    {
        return $this->twig->render($name, $parameters);
    }

    public function display(string $name, array $parameters = [])
    {
        $this->twig->display($name, $parameters);
    }
}
