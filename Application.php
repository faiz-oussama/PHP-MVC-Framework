<?php
namespace faizavel\mvc;

use faizavel\mvc\Request;
use faizavel\mvc\Router;
use faizavel\mvc\Response;
use faizavel\mvc\db\Database;
use faizavel\mvc\db\DbModel;
use faizavel\mvc\Session;
use faizavel\mvc\Controller;

class Application
{

    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public static Application $app;
    public Response $response;
    public Session $session;
    public Database $db;
    public Controller $controller;
    public ?DbModel $user;
    public View $view;
    public function __construct($rootPath,array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);
        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $this->user = new $this->userClass();
            $primaryKey = $this->user->primaryKey();
            $this->user = $this->user->findOne([$primaryKey => $primaryValue]);
        }
        else{
            $this->user = null;
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }
    public function run()
    {
        try{
            echo $this->router->resolve();
        }
        catch(\Exception $e){
            echo $this->view->renderView('_404',[
                'exception' => $e
            ]);
        }

    }
    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }
    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
    public function isGuest()
    {
        return !self::$app->user;
    }
    
}   