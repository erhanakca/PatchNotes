@extends('layout.app')
@section('content')

    <!--...............................................................................................-->
    <nav class="navbar bg-body m-sm-3" xmlns="http://www.w3.org/1999/html">
            <div class="container-fluid">
                <a class="navbar-brand text-body-secondary text-body-emphasis"><i class="bi bi-journals m-lg-2"></i>Patch Notes</a>
                <form class="d-flex" method="POST" action="{{route('create')}}">
                    @csrf
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#patchNoteModal">
                        Add New Patch Note
                    </button>
                    <div class="modal fade" id="patchNoteModal" tabindex="-1" aria-labelledby="patchNoteModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="bi bi-journals m-lg-2"></i>Add New Patch Notes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!--.....................................-->
                                    <p class="">Patch Note Type </p>
                                    <select class="form-select mb-4" name="type">
                                        <option>BUG_FİX</option>
                                        <option>NEW_PATCH</option>
                                    </select>
                                    <!--.....................................-->
                                    <p>Description </p>
                                    <textarea class="form-control mb-4" name="text"></textarea>
                                    <!--.....................................-->
                                    <p>Pick Release Date </p>
                                    <input type="date" name="date" class="form-control mb-4">
                                    <!--.....................................-->
                                    <p>Attach the Ticket Link </p>
                                    <textarea class="form-control mb-4" name="link"></textarea>
                                    <!--.....................................-->
                                    <p>Tags </p>
                                    <input class="form-control mb-4" name="tag">
                                    @foreach($tag as $item)
                                        <button class="btn btn-outline-primary bi-tags mb-1">  {{$item['name']}}</button>
                                    @endforeach
                                    <!--.....................................-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Patch Note</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <hr>
                    <form action="{{route('tagFilter')}}" method="POST">
                        @csrf
                        @foreach($tag as $item)
                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $item['name'] }}">
                                    <label type="button" class="form-check-label" for="{{ $item['name'] }}">{{ $item['name'] }}</label>
                                </div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary mt-2">Filter</button>
                    </form>
                </div>
            </div>
     <!--SAĞ KOLON-->
            <div class='col-sm-9'>
                <p  style="color: gray; font-size: 40px">Release Notes</p>
                <h6 class="text-body-secondary mb-3">This patch note does not belong to any institution.</h6>
                <hr>
                @php
                    $current_date = null;
                @endphp
                @foreach($patch_note as $item)
                    @if($item->type == 1)
                        @if($current_date != $item->date->format('d-m-Y'))
                            <p class="alert alert-primary fs-4 d-md-flex">{{$item->date->format('d-m-Y')}}</p>
                            @php
                                $current_date = $item->date->format('d-m-Y');
                            @endphp
                        @endif
                        <div class="bg-light p-3 rounded mb-2" style="">
                            <p class="fs-5 text-danger">Bugfix</p>
                            <p class="fs-7">{{$item->text}}</p>
                            <a href="" class="btn bi bi-box-arrow-up-right text-info">&nbsp; https://getbootstrap.com/docs/5.3/utilities/text/#font-size</a>
                            <br>
                            <br>
                        </div>
                    @endif
                @endforeach

                @php
                    $current_date = null;
                @endphp
                @foreach($patch_note as $item)
                    @if($item->type == 0)
                        @if($current_date != $item->date->format('d-m-Y'))
                            <p class="alert alert-primary fs-4 d-md-flex">{{$item->date->format('d-m-Y')}}</p>
                            @php
                                $current_date = $item->date->format('d-m-Y');
                            @endphp
                        @endif
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
