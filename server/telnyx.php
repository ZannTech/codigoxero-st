<?php
define('API_TELNYX', Session::get('API_KEY_TELNYX'));
define('FROM_TELNYX', Session::get('FROM_NUMBER_TELNYX'));
define('USER_ID_TELNYX', Session::get('USER_ID_WHATSAPP'));

class TelnyxSender
{
    var $apik = API_TELNYX;
    var $from = FROM_TELNYX;
    var $userid_w = USER_ID_TELNYX;
    public function sendMessage(String $to = null, String $message = null)
    {
        \Telnyx\Telnyx::setApiKey(API_TELNYX);
        \Telnyx\Message::Create([
            "from" => FROM_TELNYX,
            "to" => $to,
            "text" => $message . ''
        ]);
    }
    public function sendWhatsapp(String $to = null, String $message = null, String $media_url = null)
    {

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.telnyx.com/v2/whatsapp_messages',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "whatsapp_user_id": "{{$this->userid_w}}",
          "to": "{{$to}}",
          "type": "text",
          "text": {
            "body": "{{$message}}"
          }
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer {{$apik}}'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
        
    }
}
