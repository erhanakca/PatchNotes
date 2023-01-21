@extends('layout.app')
@section('content')

    <!--...............................................................................................-->
        <nav class="navbar bg-body m-sm-3">
            <div class="container-fluid">
                <a class="navbar-brand text-body-secondary text-body-emphasis"><i class="bi bi-journals m-lg-2"></i>Patch Notes</a>
                <form class="d-flex" action="#">
                    <button class="btn btn-success" type="submit">Add New Patch Note</button>
                </form>
            </div>
        </nav>
    <!--...............................................................................................-->
    <!--SOL COLON-->
        <div class="row mt-5 m-sm-3">
            <div class='col-sm-3'>
                <footer class="text-body-secondary mb-3">Pick Release Date</footer>
                <hr class="mb-5">
                <div class="form-group">
                    <form action="#">
                    <div class='input-group date mb-3'>
                        <input type="date" class="form-control" placeholder="dd.mm.yyyy" />
                    </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="button" class="btn btn-success" onclick="location.reload()">Reset All Filters</button>
                    </form>
                </div>
            </div>
     <!--SAĞ COLON-->
            <div class='col-sm-9'>
                <footer  style="color: gray; font-size: 40px">Release Notes</footer>
                <h6 class="text-body-secondary mb-3">This patch note does not belong to any institution.</h6>
                <hr>

                <p class="alert alert-primary fs-4 d-md-flex">04.10.1985</p>
                <p class="fs-5 text-danger">BugFix</p>
                <p class="fs-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam</p>
                <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp;&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
                <br>
                <br>
                <p class="alert alert-primary fs-4 ">17.05.2022</p>
                <p class="fs-5 text-primary">New</p>
                <p class="fs-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam</p>
                <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp;&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
            </div>
        </div>
    <!--...............................................................................................-->


        <div class="row m-sm-3">
            <div class=''>
                <footer class="text-body-secondary "><br>Tags</footer>
                <hr class="">
                @foreach($tag as $item)
                <button type="submit" class="btn btn-outline-danger bi-tags m-sm-1">  {{$item['name']}}</button>
                @endforeach
            </div>
        </div>







@endsection
