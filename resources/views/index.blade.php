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
    <!--SOL KOLON-->
        <div class="row mt-5 m-sm-3">
            <div class='col-sm-3'>
                <p class="text-body-secondary mb-3">Pick Release Date</p>
                <hr class="mb-5">
                <div class="form-group">
                    <form type="date" action="{{route('dateFilter')}}" method="GET">

                    <div class='input-group date mb-3'>
                        <input type="date" name="date" class="form-control"/>
                    </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="reset" class="btn btn-success">Reset All Filters</button>
                    </form>
                </div>
                <div class='mb-3'>
                    <p class="text-body-secondary "><br>Tags</p>
                    <hr class="">
                    @foreach($tag as $item)
                    <button type="submit" class="btn btn-outline-primary bi-tags mb-1">  {{$item['name']}}</button>
                    @endforeach
                </div>
            </div>

     <!--SAĞ KOLON-->
            <div class='col-sm-9'>
                <p  style="color: gray; font-size: 40px">Release Notes</p>
                <h6 class="text-body-secondary mb-3">This patch note does not belong to any institution.</h6>
                <hr>
                    <p class="alert alert-primary fs-4 d-md-flex"></p>
                    @foreach($patch_note as $item)
                    @if($item->type == 1)
                        <div class="bg-light p-3 rounded mb-2" style="">
                            <p class="fs-5 text-danger">Bugfix</p>
                            <p class="fs-7">{{$item->text}}</p>
                            <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
                            <br>
                            <br>
                        </div>
                    @endif
                    @endforeach

                    @foreach($patch_note as $item)
                    @if($item->type == 0)
                        <div class="bg-light p-3 rounded mb-2" style="">
                            <p class="fs-5 text-primary">New</p>
                            <p class="fs-7">{{$item->text}}</p>
                            <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
                            <br>
                            <br>
                        </div>
                    @endif
                    @endforeach
            </div>
        </div>
    <!--...............................................................................................-->










@endsection
