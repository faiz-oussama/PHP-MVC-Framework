<?php
namespace faizavel\mvc;
use faizavel\mvc\Application;
use faizavel\mvc\middlewares\BaseMiddleware;

class Controller
{
    /**
     * @var \faizavel\mvc\middlewares\BaseMiddleware[]
     */
    public array $middlewares = [];
    public string $layout = 'main';
    public string $action = '';
    public function render($view,$params = [])
    {
        return Application::$app->view->renderView($view,$params);
    }
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }
    public function getMiddleware()
    {
        return $this->middlewares;
    }
}   