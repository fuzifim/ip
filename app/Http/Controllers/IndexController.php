<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Cache;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Redirect;
use DB;
class IndexController extends Controller
{
    public $_domain;
    public $_title;
    public $_description;
    public $_keyword;
    public $_basicInfo;
    public $_websiteInfo;
    public $_semrushMetrics;
    public $_dnsReport;
    public $_ipAddressInfo;
    public $_whoisRecord;
    public $_ads_status;
    public function __construct(){
    }
    public function index(Request $request){
        $page = $request->has('page') ? $request->query('page') : 1;
        $listIp = Cache::store('memcached')->remember('listIp_page_'.$page,1, function()
        {
            return DB::table('ips')->where('status','active')->orderBy('updated_at','desc')->simplePaginate(20);
        });
        return view('index',array(
            'listIp'=>$listIp
        ));
    }
    public function viewIp(Request $request){
        $ip = $request->route('ip');
        if(!empty($ip)){
            $getIp = Cache::store('memcached')->remember('ip_'.base64_encode($ip),1, function() use($ip)
            {
                return DB::table('ips')->where('base_64',base64_encode($ip))
                    ->where('status','active')
                    ->first();
            });
            $listNew = Cache::store('memcached')->remember('listNew',1, function()
            {
                return DB::table('ips')->where('status','active')->orderBy('updated_at','desc')->take(20)->get();
            });
            if(!empty($getIp->ip)){
                return view('viewIp',array(
                    'ip'=>$getIp,
                    'listNew'=>$listNew
                ));
            }
        }
    }
    public function getIpFromUrl(){
        try {
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'text/html',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'
                ],
                'connect_timeout' => '50',
                'timeout' => '50'
            ]);
            $getSiteUrl=DB::table('site_url')->where('site','tracemyip')->where('type','add')->first();
            if(empty($getSiteUrl->site)){
                DB::table('site_url')->insert(
                    [
                        'site' => 'tracemyip',
                        'url_list' => '',
                        'page'=>1,
                        'type'=>'add',
                        'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
                    ]
                );
                $pageUrl=1;
            }else{
                $pageUrl=$getSiteUrl->page;
            }
            DB::table('site_url')->where('site','tracemyip')
                ->update(['page' => $pageUrl+1,'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
            $response = $client->request('GET', 'https://tools.tracemyip.org/search--ip/list:-v-:&gTr='.$pageUrl.'&gNr=50');
            $getResponse=$response->getBody()->getContents();
            $dom = new \DOMDocument;
            @$dom->loadHTML($getResponse);
            $xpath = new \DOMXPath($dom);
            $results = $xpath->query('//table[@id="tlzRDTIPv4"]');
            if ($results->length > 0) {
                $review = $results->item(0);
                $tr=$review->getElementsByTagName('tr');
                for ($x = 0; $x < $tr->length; $x++) {
                    if($x>0){
                        $td=$tr->item($x)->getElementsByTagName('td');
                        for ($y = 0; $y < $td->length; $y++) {
                            if($y==1){
                                $ip=$td->item($y)->nodeValue;
                            }
                            if($y==2){
                                $org=$td->item($y)->nodeValue;
                            }
                            if($y==3){
                                $country=$td->item($y)->nodeValue;
                            }
//                            if($y==4){
//                                $city=$td->item($y)->nodeValue;
//                            }
                            if($y==5){
                                $city=$td->item($y)->nodeValue;
                            }
                            if($y==6){
                                $timezone=$td->item($y)->nodeValue;
                            }
                            if($y==7){
                                $browser=$td->item($y)->nodeValue;
                            }
                            if($y==8){
                                $opera_system=$td->item($y)->nodeValue;
                            }
                        }
                        $checkExist=DB::table('ips')->where('ip',base64_encode($ip))->first();
                        if(empty($checkExist->ip)){
                            DB::table('ips')->insert(
                                [
                                    'ip'=>$ip,
                                    'base_64'=>base64_encode($ip),
                                    'org'=>$org,
                                    'city'=>$city,
                                    'country'=>$country,
                                    'timezone'=>$timezone,
                                    'browser'=>$browser,
                                    'operating_system'=>$opera_system,
                                    'by'=>'tracemyip',
                                    'status'=>'active',
                                    'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                                    'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
                                ]
                            );
                        }
                        echo $ip.'-'.$org.'-'.$country.'-'.$city.'-'.$timezone.'-'.$browser.'-'.$opera_system.'<p>';
                    }
                }
//                foreach ($tr as $item){
//                    echo $item->nodeValue.'<p>';
//                    $td=$item->getElementsByTagName('td');
//                    for()
//                    foreach ($td as $iTd){
//                        $ip=$iTd->nodeValue;
//                        echo $ip.'<p>';
//                    }
//                }
            }
        }catch (\GuzzleHttp\Exception\ServerException $e){
            return 'false';
        }catch (\GuzzleHttp\Exception\BadResponseException $e){
            return 'false';
        }catch (\GuzzleHttp\Exception\ClientException $e){
            return 'false';
        }catch (\GuzzleHttp\Exception\ConnectException $e){
            return 'false';
        }catch (\GuzzleHttp\Exception\RequestException $e){
            return 'false';
        }
    }
}