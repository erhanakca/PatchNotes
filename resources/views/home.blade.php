@extends('layout.app')
@section('content')

    <!--...............................................................................................-->
        <nav class="navbar bg-body-tertiary m-sm-3">
            <div class="container-fluid">
                <a class="navbar-brand text-body-secondary text-body-emphasis"><i class="bi bi-journals m-lg-2"></i>Patch Notes</a>
                <form class="d-flex" action="#">
                    <button class="btn btn-success" type="submit">Add New Patch Note</button>
                </form>
            </div>
        </nav>
    <!--...............................................................................................-->
        <div class="row mt-5 m-sm-3">
            <div class='col-sm-3'>
                <footer class="text-body-secondary mb-3">Pick Release Date</footer>
                <hr class="mb-5">
                <div class="form-group">
                    <form action="#">
                    <div class='input-group date mb-3'>
                        <input type='date' class="form-control" placeholder="dd.mm.yyyy" />
                    </div>
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                        <button type="submit" class="btn btn-outline-success">Reset All Filters</button>
                    </form>
                </div>
            </div>
        </div>
    <!--...............................................................................................-->


    <div class="row  m-sm-3">
        <div class='col-sm-3'>
            <footer class="text-body-secondary mt-sm-5 "><br>Tags</footer>
            <hr class="">
            @foreach($data as $item)
            <button type="submit" class="btn btn-danger m-sm-1">{{$item['name']}}</button>
            @endforeach
        </div>
    </div>







@endsection
