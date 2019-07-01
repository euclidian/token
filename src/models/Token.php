<?php

namespace Tiketux\Token\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use GuzzleHttp\Client;
use DB;

class Token extends Model
{
	use LogsActivity;

	protected $guarded = [];

	protected static $logAttributes = ['*'];

	protected $table = 'tbl_token';


	public function getToken($group = "testing", $url = "http://202.67.9.37:8912/oauth/token",$grant_type = "password", $client_id = 2,$client_secret = "YCl4y9g1MrbOJFWDmbfRUsOeLlh0kYfKnoD9DYPd",$username = "a@a.com",$password = "123456"){

		$data_akhir = [];
		$data       = $this->where("group_name",$group)->orderBy("created_at","DESC")->first();

		if((!$data) || (date("Y-m-d") > date('Y-m-d', strtotime('+2 month', strtotime($data->created_at))))){
			$http = new Client();

			$response = $http->post($url, [
				'form_params' => [
					'grant_type' 	=> $grant_type,
					'client_id' 	=> $client_id,
					'client_secret' => $client_secret,
					'username' 		=> $username,
					'password' 		=> $password,
					'scope' 		=> '',
				],
			]);
			$data = json_decode($response->getBody()->getContents());

			$this->create([
				"group_name"	=> $group,
				"token"			=> $data->access_token
			]);
			$data = $this->where("group_name",$group)->orderBy("created_at","DESC")->firstOrFail();
		}
		return $data;
	}
}