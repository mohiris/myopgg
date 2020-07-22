<div class="container">
        <h2 class="p-2 text-info">Result of search for : {{ $data['name']}}</h2>
        <hr>
        <div class="row p-4">
            <div class="row">
                <div class="col-md-6 p-4">
                    <h3 class="text-secondary">{{ $data['name'] }}</h3>
                    <img src="//placehold.it/125" class="m-x-auto img-fluid img-circle rounded" alt="avatar">
                </div>
                <div class="col-md-6 p-4 bg-light">
                    <h3 class="text-secondary" >Ranked</h3>
                    <ul>
                    <li class="text-secondary">Level: <span class="ranked_info">{{ $data['level']}}</span></li>
                    <li class="text-secondary">Rank: <span class="ranked_info">{{ $data['tier']  }} {{$data['rank'] }}</span></li>
                        <li class="text-secondary">Win ratio: <span class="ranked_info"ranked_info>52%</span></li>
                        <li class="text-secondary">Division: <span class="ranked_info">La puissance de Nasus</span></li>
                    </ul>
                </div>

                <div class="col-md-12 mt-4 p-4">
                    <h3>Champions</h3>
                    @for ($i = 0; $i < count($data['stats']); $i++)
                    
                     <div class="d-flex flex-row mt-2 @if($data['stats'][$i]['win'] == true) bg-success @else bg-danger @endif text-primary">
                        
                            <div class="p-4 bg-dark text-light">
                            <p class="champion-name">{{ getChampion($data['championId'][$i])}}</p>
                                <p class="champion-img"><img src="//placehold.it/35" class="rounded-circle"></p>
                            </div>

                            <div class="p-4">
                                    <p class="champion_name">Lane</p>
                            <p class="champion-img">{{ $data['lane'][$i]}}</p>    
                            </div>
                            <div class="p-4">
                                <p class="champion_name">First blood</p>
                                <p class="champion-img">@if($data['stats'][$i]['firstBloodKill']) Yes @else No @endif</p>    
                            </div>
                            <div class="p-4">
                                    <p class="champion_name">K/D/A</p>
                            <p class="champion-img">{{ $data['stats'][$i]['kills'] .'/' . $data['stats'][$i]['deaths'] . '/' . $data['stats'][$i]['assists']}}</p>
                            </div>
                            <div class="p-4">
                                    <p class="champion_name">Game</p>
                            <p class="champion-img"> @if($data['stats'][$i]['win'] == true) Victory @else Defeat @endif</p>
                            </div>
                          
                     </div>
                     
                     @endfor    
                </div>
        </div>
</div>