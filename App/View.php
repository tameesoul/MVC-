<?php


namespace App;

use App\Exception\ViewNotFound;


class View
{

    public function __construct(protected $view , protected  $data = [])
    {
    }


    public static function make($view , $data = [])
    {
        return new static($view, $data);
    }
    public function render ()
    {

        extract($this->data);
        ob_start();
        $viewPath = VIEW_PATH.$this->view.".php";

        if(file_exists($viewPath )) {

            include $viewPath;
            return (string) ob_get_clean();
        }else
        {
            throw new ViewNotFound();
        }
    }


    public function __tostring()
    {
        return $this->render();
    }
}