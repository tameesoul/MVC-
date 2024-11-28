<?php
namespace App\Controller;
use App\Models\User;
use App\View;
use App\Attributes\Route;
class HomeController 
{
    #[Route('/', 'GET')]
    public function index()
    {
        $user = new User;
        // try{

        //     $user->create([
        //         'name'=>'ahmed tamer elsayed ghazy',
        //         'phone'=>'0111000002233334',
        //         'email'=>'ahmedtamerelsayed@gmail.com',
        //     ]);
        // }catch(PDOException $e)
        // {
        //     if($e->getCode() == "23000")
        //     {
        //         echo "email or phone has been used before";
        //     }
        // }

      dd($user->where('name','ahmed')->first());
        //dd($user);
         return View::make('home/index',['user'=>$user]);
    }

    public function upload()
    {
        $file = $_FILES['uploaded_file'];
        if($file['error'] === 0)
        {
            $destination = STORAGE_PATH.basename($file['name']);

            move_uploaded_file($file['tmp_name'], $destination);
            echo "File uploaded successfully";
        }else
        {
            echo "Error: ".$file['error'];
        }

    }
}