<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $summonerData;
    private $base = "https://euw1.api.riotgames.com";
    private $matchData = [];
    private $gameId = [];
    private $championId = [];

    public function index(Request $request)
    {
        if($request->input('username')){
            $this->getSummoner($request->input('username'));
        }else{

            $this->getSummoner('beansu');
        }

        $league = $this->getLeague($this->summonerData['id'])[0];
        $matches = array_slice($this->getMatches($this->summonerData['accountId'])['matches'], 0,10);
        //dd($matches);
    
        for($i = 0; $i < count($matches); $i++){
            foreach($matches[$i] as $key => $value){
                
                if($key == 'gameId'){
                    $this->gameId[]= $value;
                }
                
                if($key == 'champion'){
                    $this->championId[] = $value;
                    
                }
                
                if($key == 'lane'){
                    $lane[] = $value;
                    $this->matchData['lane'] = $lane;
                }
            }
        }

        $games = [];
        for($i = 0; $i < count($this->gameId); $i++){
            $games[] = $this->getMatch($this->gameId[$i]);
        }

        //dd($games);
        $participants = [];
        for($i = 0 ; $i < count($games); $i++){
            foreach($games[$i] as $key => $value){
                if($key == 'participants'){
                    $participants[] = $value;
                }
            }
        }

        $stats = [];
        for($i = 0; $i < count($participants); $i++){
            for($j = 0 ; $j < count($participants[$i]); $j++){
                foreach($participants[$i][$j] as $key => $value){
                    if($key == 'championId' && $value == $this->championId[$i]){
                        $stats[] = $participants[$i][$j]['stats'];
                    }
                }
            }
        }
        //dd($stats);
        $matchStat = [];
        $gamesStats = [];
        for($i = 0; $i < count($stats); $i++){
            foreach($stats[$i] as $key => $value){

                if($key == 'win'){
                    $matchStat['win'] = $value;
                   
                }else if($key == 'kills'){
                    $matchStat['kills'] = $value;
                    
                }else if($key == 'deaths'){
                    $matchStat['deaths'] = $value;
                    
                }else if($key == 'assists'){
                    $matchStat['assists'] = $value;
                    
                }else if($key == 'firstBloodKill'){
                    $matchStat['firstBloodKill'] = $value;
                }

                
            }

            $gamesStats[] = $matchStat;
        }
        //dd($this->championId);

        $data = [
            'name' => $this->summonerData['name'],
            'tier' => $league['tier'],
            'rank' => $league['rank'],
            'level' => $this->summonerData['summonerLevel'],
            'stats' => $gamesStats,
            'lane' => $this->matchData['lane'],
            'championId' => $this->championId
        
        ];


        return view('home/index', ['data' => $data]);

    }


    public function getGuzzleRequest($url)
    {   
        $client = new \GuzzleHttp\Client();
        $request = $client->get($url."?api_key=RGAPI-304d4c3c-4a76-44d8-b1fd-ff607639ede8");

        $response = $request->getBody()->getContents();
   
        return json_decode($response, true);
    }

    public function getSummoner($username="beansu"){

        $url = $this->base. "/lol/summoner/v4/summoners/by-name/".$username;
        $this->summonerData = $this->getGuzzleRequest($url);
    }



    public function getLeague($id){

        $url = $this->base."/lol/league/v4/entries/by-summoner/".$id;
        return $this->getGuzzleRequest($url);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMatch($id)
    {
        $url = $this->base."/lol/match/v4/matches/".$id;
        return $this->getGuzzleRequest($url);
    }

    public function getMatches($id){
        
        $url = $this->base. "/lol/match/v4/matchlists/by-account/".$id;
        return $this->getGuzzleRequest($url);
    }


}
