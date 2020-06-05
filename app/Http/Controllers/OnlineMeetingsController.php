<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use \Datetime;
use \DateInterval;

class OnlineMeetingsController extends Controller
{

  public function onlineMeeting() {
    return view('meeting');
  }
  public function onlineMeetingCreate(Request $request)
  {
   // $viewData = $this->loadViewData();
     $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'startDateTime' => 'required'
        ]);

   

    // Get the access token from the cache
    $tokenCache = new TokenCache();
    $accessToken = $tokenCache->getAccessToken();

    // Create a Graph client
    $graph = new Graph();
    $graph->setAccessToken($accessToken);
    $inviteEmail=$data['email'];
    $subject = $data['subject'];

    $date= new DateTime($data['startDateTime']);
    $date_end= clone($date);
    $date_end->add(new DateInterval('PT1H'));

    


   

  /*  $onlineMeeting =[
      "startDateTime"=>"2020-07-12T14:30:34.2444915-07:00",
       "endDateTime"=>"2020-07-12T15:00:34.2464912-07:00",
      "subject"=>"test Online Meeting"
    ]; 
*/
    $onlineMeeting1 =[
        "Subject" => "Online meeting with ".$data['name'],
        "Body" => [
          'contentType'=> "HTML",
          'content' => $subject,


        ],
        'start'=>  [
          'datetime' => $date->format('Y-m-d\TH:i:s'),
          'timeZone' => "Europe/Paris"
        ],
        
        'end' => [
             'datetime' => $date_end->format('Y-m-d\TH:i:s'),
          'timeZone' => "Europe/Paris"
        ],

        'attendees'=> [[
            'emailAddress'=> [
              'address'=> $data['email'],
              'name' => $data['name']
            ] ,
              'type'=>"required"
            
        ]] ,
        'isOnlineMeeting' => true,
        'onlineMeetingProvider'=> 'teamsForBusiness'



    ];

   

    
    $putOnlineMeetingUrl = 'onlineMeetings';

    print_r(json_encode($onlineMeeting1));

 /* $event= $graph->createRequest("POST", "/me/onlineMeetings")
    ->attachBody($onlineMeeting)
    ->setReturnType(Model\OnlineMeeting::class)
    ->execute();
    */
    try {
  $calendarEvent = $graph->createRequest("POST","/me/events")
  ->attachBody($onlineMeeting1)
  ->setReturnType(Model\Event::class)
  ->execute();
} catch (\Exception $e) {
  print_r($e->getMessage());
  die;
}
//return view('onlineMeeting', $viewData); 
  var_dump($calendarEvent);
  die;
  //  return response($calendarEvent->getJoinUrl());
  }
}