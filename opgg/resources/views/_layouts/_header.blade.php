<div style="padding-left:0; padding-right: 0" class="container-fluid">
    <div class="jumbotron header_bg">
        <div class="container">
  
                <div class="d-flex flex-column">
                        <div class="p-2">
                                <h1 class="text-center text-white">The best <a style="text-decoration: none" href="" class="text-info">League Of Legends </a> search engine</h1>
                        </div>
                        <div class="p-2">
                            <form action="/summoner" mthod="post" class="form-inline jsutfy-content-center">
                                @csrf
                                    <div style="margin: 0 auto" class="form-group input-group-lg">
                                        <input class="form-control mr-sm-2" type="text" name="username" placeholder="search a summoner"/>
                                        <input style="padding: 0.6rem; font-size: 1rem" type="submit" class="btn btn-info" value="summon" name="search">
                                    </div>
                            </form>
                        </div>               
                </div>   
        </div>
    </div>
</div>