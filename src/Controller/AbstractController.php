<?php

namespace Lenvendo\Canvas\Controller;

use Lenvendo\Canvas\Service\Twig\Twig;
use yii\web\Controller;

abstract class AbstractController extends Controller
{

    /** @var Twig */
    private $twig;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->twig = \Yii::$app->get('twig');
    }

    public function render($template, $params = []): string
    {
        return $this->twig->render($template, $params);
    }

    protected function respondJson($data = []): string
    {
        return json_encode($data);
    }

    protected function getService(string $serviceName)
    {
        return \Yii::$app->get($serviceName);
    }

    /**
     * @return string|null
     */
    protected function getParameter(string $name)
    {
        return \Yii::$app->request->post($name);
    }
}
