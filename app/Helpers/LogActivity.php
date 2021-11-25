<?php


namespace App\Helpers;
use Request;
use Session;
use App\LogActivity as LogActivityModel;


class LogActivity
{


    public static function addToLog($action)
    {
    	$log = [];
    	$log['url'] = Request::fullUrl();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
		$log['action'] = json_encode($action);
		$log['sessionid'] = Session::getId();
    	LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->get();
    }


}