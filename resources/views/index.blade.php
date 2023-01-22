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
                    <form action="{{route('filter')}}" method="POST">
                        @csrf
                    <div class='input-group date mb-3'>
                        <input type="date" name="date" class="form-control" placeholder="dd.mm.yyyy" />
                    </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="reset" class="btn btn-success">Reset All Filters</button>
                    </form>
                </div>
                <div class='mb-3'>
                    <footer class="text-body-secondary "><br>Tags</footer>
                    <hr class="">
                    @foreach($tag as $item)
                    <button type="submit" class="btn btn-outline-danger bi-tags">  {{$item['name']}}</button>
                    @endforeach
                </div>
            </div>

     <!--SAĞ COLON-->
            <div class='col-sm-9'>
                <footer  style="color: gray; font-size: 40px">Release Notes</footer>
                <h6 class="text-body-secondary mb-3">This patch note does not belong to any institution.</h6>
                <hr>
                    <p class="alert alert-primary fs-4 d-md-flex">{{session('date')}}</p>
                    @foreach($patch_note as $item)
                    @if($item['type'] == 1)
                    <p class="fs-5 text-danger">Bugfix</p>
                    <p class="fs-7">{{$item['text']}}</p>
                    <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp;&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
                    <br>
                    <br>
                    @endif
                    @endforeach

                    <p class="alert alert-primary fs-4 ">{{session('date')}}</p>
                    @foreach($patch_note as $item)
                    @if($item['type'] == 0)
                    <p class="fs-5 text-primary">New</p>
                    <p class="fs-7">{{$item['text']}}</p>
                    <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp;&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
                    <br>
                    <br>
                    @endif
                    @endforeach
            </div>
        </div>
    <!--...............................................................................................-->










@endsection
