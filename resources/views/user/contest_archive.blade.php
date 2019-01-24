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
    <div class="container">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <input type="text" id="myInput" onkeyup="myFunction()" name="search" placeholder="Search Contest Title..." autofocus>
                <br>
                <br>
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Contest Title</th>
                        <th>Contest Rank List</th>
                    </tr>
                    </thead>

                    <tbody>

                    @php
                        $contests = DB::table('problems')->select('contest_id','contest_title')->distinct()->orderby('contest_id','desc')->get();
                        $serial = 0;


                    @endphp

                    @foreach($contests as $contest)
                        <tr>
                            <td>{{ ++$serial }}</td>
                            <td>{{$contest->contest_title}}</td>
                            @php
                                $url = "/home/single/contest/".strval($contest->contest_id);
                            @endphp

                            <td>  <a href= {{ $url }} > Rank of {{ $contest->contest_title }} </a> </td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>
            <div class="col-md-3"></div>

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
@endsection()
