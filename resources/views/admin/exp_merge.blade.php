@extends('admin.master')

@section('style')
    #searchBox{
        background-image: url("https://www.w3schools.com/howto/searchicon.png");
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 2px solid #ddd;
        margin-bottom: 12px;
    }
@endsection

@section('content')
    @php

        $checked_contest= json_decode( json_encode($checked_contest), true);


        $contestants = DB::table('ranklists')
                    ->select('username',DB::raw('SUM(score) as tscore'),DB::raw('SUM(penalty) as tpenalty'))
                    ->groupBy('username')
                    ->whereIn('contest_id', $checked_contest)
                    ->orderBy('tscore','desc')
                    ->orderBy('tpenalty','asc')
                    ->get();
        $rank = 0;

    @endphp

    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <input type="text" id="searchBox" onkeyup="myFunction()" name="search" placeholder="Search Username..." autofocus>
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Score</th>
                        <th>Penalty</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($contestants as $contestant)
                        <tr>
                            <td>{{ ++$rank }}</td>
                            <td>{{ $contestant->username }}</td>
                            <td>{{ $contestant->tscore }}</td>
                            <td>{{ $contestant->tpenalty }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>


            <div class="col-md-3">
                <div class="card">


                    @php
                        $titles = DB::table('problems')->select('contest_title','contest_id')
                        ->whereIn('contest_id',$checked_contest)
                        ->orderby('contest_id','desc')
                        ->distinct()
                        ->get();

                    $ok = true;

                    @endphp
                    <ul class="list-group list-group-flush">

                        <li style="text-align: center" class="list-group-item"><strong>Merged contest list</strong></li>

                        @foreach($titles as $title)
                            <li style="text-align: center" class="list-group-item">{{$title->contest_title}} </li>
                        @endforeach

                    </ul>
                </div>

            </div>
            <div class="col-md-1"></div>
        </div>
    </div>




    <script>
        function myFunction() {
            var input = document.getElementById("searchBox");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("myTable");
            var tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[1];

                if(td) {
                    var txtValue = td.textContent || td.innerText;
                    if(txtValue.toUpperCase().indexOf(filter)> -1){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }

                }
            }

        }
    </script>

@endsection
