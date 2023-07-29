<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class MailController extends Controller
{
  public function getMessages(Request $request) {
  
  
  $config = [
             'host' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => 'mydevtest84@gmail.com',
            'password' => 'kbmpfiplwdsxaamp',
            'protocol' => 'imap'
        ];


$oClient = \Webklex\IMAP\Facades\Client::make($config);
     
    $oClient->connect();
    $aFolder = $oClient->getFolder('[Gmail]');
    

    // $children = $aFolder->children;
//       // Loop through the children folders and display their names
//       foreach ($children as $childFolder) {
//           $hshs =  $childFolder->getName() . PHP_EOL;
//           dd($hshs);
//       }
    
    
    $paginator = $aFolder->search()
    ->since(Carbon::now()->subDays(14))->get()
    ->paginate(1);
    
    $oClient->disconnect();
    return view('mail-inbox.mail-listing',[
      'paginator' => $paginator
    ]);
  }
  

  
}