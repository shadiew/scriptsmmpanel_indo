<?php
/* 
Script Topup Otomatis Via Pulsa TSEL
Creator : Salman El Faris
Editor : ATL
 */
require_once "config.php";
require_once "EnvayaSMS.php";
require_once "../mainconfig.php";
$request = EnvayaSMS::get_request();
header("Content-Type: {$request->get_response_type()}");
if (!$request->is_validated($PASSWORD))
{
    header("HTTP/1.1 403 Forbidden");
    error_log("Invalid password");    
    echo $request->render_error_response("Invalid password");
    return;
}
$action = $request->get_action();
switch ($action->type)
{
    case EnvayaSMS::ACTION_INCOMING:    
        
        // Send an auto-reply for each incoming message.
    
        $type = strtoupper($action->message_type);
        $isi_pesan = $action->message;
    include('tsel.php');
    include('xl.php');
    
        error_log("Received $type from {$action->from}");
        error_log(" message: {$action->message}");
        
        return;
}