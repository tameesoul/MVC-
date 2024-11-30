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
        $handle = curl_init();
    
        $uri = 'https://api.emailable.com/v1/verify?email=tamerghazy@std.mans.edu.eg';

        curl_setopt($handle, CURLOPT_URL, $uri);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer test_017265a5bea968340b20', 
        ]);

        $response = curl_exec($handle);

        if (curl_errno($handle)) {
            dd('cURL Error: ' . curl_error($handle));
        }
    
        curl_close($handle);

        dd($response);
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