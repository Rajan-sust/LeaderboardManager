@extends('user.master')


@section('style')
    #myInput {
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
        $title = DB::table('problems')->select('contest_title')->where('contest_id',$id)->distinct()->first();
    @endphp

    <h2 style="text-align: center">{{ $title->contest_title }}</h2>


    <div class="container">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <input type="text" id="myInput" onkeyup="myFunction()" name="search" placeholder="Search Username..." autofocus>
                <br>
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

                    @php
                        $contestants = DB::table('ranklists')->where('contest_id',$id)->orderBy('score', 'desc')->orderBy('penalty','asc')->get();
                        $rank = 0

                    @endphp

                    @foreach($contestants as $contestant)
                        <tr>
                            <td>{{ ++$rank }}</td>
                            <td>{{ $contestant->username }}</td>
                            <td>{{ $contestant->score }}</td>
                            <td>{{ $contestant->penalty }}</td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>
            <div class="col-md-1"></div>

        </div>

    </div>


    <script>
        function myFunction() {
            var input = document.getElementById("myInput");
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
