@extends('layout.app')
@section('content')

    <!--...............................................................................................-->
    <nav class="navbar bg-body m-sm-3" xmlns="http://www.w3.org/1999/html">
            <div class="container-fluid">
                <a href="{{route('index')}}" class="navbar-brand text-body-secondary text-body-emphasis"><i class="bi bi-journals m-lg-2"></i>Patch Notes</a>
                <form class="d-flex" method="POST" id="create_form" action="{{route('create')}}">
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
                                        <option>BUG_FIX</option>
                                        <option>NEW_PATCH</option>
                                    </select>
                                    <!--.....................................-->
                                    <p>Description </p>
                                    <textarea class="form-control mb-4" name="text"></textarea>
                                    <!--.....................................-->
                                    <p>Pick Release Date </p>
                                    <input type="date" name="date" class="form-control mb-4" id="today">
                                    <!--.....................................-->
                                    <p>Attach the Ticket Link </p>
                                    <textarea class="form-control mb-4" name="link"></textarea>
                                    <!--.....................................-->
                                    <p>Tags </p>
                                    <input class="form-control mb-4" name="tag" id="tagInput">
                                    @foreach($tag as $item)
                                        <button class="btn btn-outline-primary bi-tags mb-1" onclick="addTag(this)">  {{$item['name']}}</button>
                                    @endforeach
                                    <!--.....................................-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" form="create_form" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" onclick="submitForm()" >Save Patch Note</button>
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
                    <div class='text-area mb-3'>
                        <input type="date" name="date" class="form-control"/>
                    </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="reset" class="btn btn-success">Reset All Filters</button>
                    </form>
                </div>
                <p class="text-body-secondary mt-3"><br>Filter By Tags</p>
                <hr>
                @foreach($tag as $item)
                    <button style="background-color: lightblue"  class="btn btn-outline-primary bi-tags mb-1" onclick="addTagFilter(this)"> {{$item['name']}}</button>
                @endforeach

                <form action="{{route('tagFilter')}}" method="POST" id="tagFilterForm">
                    @csrf
                    @method('GET')
                    <textarea class="form-control mb-4 mt-5" name="tag" id="tagFilterInput"></textarea>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" id="chosenOnes">Filter</button>
                        <button type="reset" class="btn btn-success">Reset All Filters</button>
                    </div>
                </form>
            </div>
     <!--SAĞ KOLON-->
            <div class='col-sm-9'>
                <p  style="color: gray; font-size: 40px">Release Notes</p>
                <h6 class="text-body-secondary mb-3">This patch note does not belong to any institution.</h6>
                <hr>

                @foreach($date_array as $date)
                    <p class="alert alert-primary fs-4 d-md-flex">{{$date->format('d-m-Y')}}</p>
                    @foreach($patch_note as $item)
                        @if($item->date == $date)
                        <div class="bg-light p-3 rounded mb-2">
                            @if($item->type == 1)
                            <p class="fs-5 text-danger">Bug Fix</p>
                            @else
                            <p class="fs-5 text-primary">New Patch</p>
                            @endif
                            <p class="fs-7">{{$item->text}}</p>
                            @foreach($item->PatchNoteLink as $link)
                            <a href="{{$link->link}}" type="url" target="_blank" class="btn bi bi-box-arrow-up-right text-info"> {{$link->link}}</a>
                            <br>
                            @endforeach
                            <br>
                            <br>
                            <br>
                            @php $control = array(); @endphp
                            @foreach($item->patchNoteTags as $tags)
                                @if(!in_array($tags['name'], $control))
                            <button style="background-color: lightblue" class="btn btn-outline-primary bi-tags mb-1" disabled> {{$tags['name']}}</button>
                                @php $control[] = $tags['name']; @endphp
                                @endif
                            @endforeach
                            <br>
                            <br>
                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <form  class="d-inline" method="POST" id="update_form" action="{{route('update', $item->patch_note_id)}}" >
                                    @csrf
                                    @method('PUT')
                                    <button style="font-size: 20px" type="button" id="update_form" class="btn bi bi-pencil text-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$item->patch_note_id, $item->patch_note_link_id}}"></button>
                                    <div class="modal fade" id="updateModal{{$item->patch_note_id, $item->patch_note_link_id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><i class="bi bi-journals m-lg-2"></i>Update</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!--.....................................-->
                                                    <p class="">Patch Note Type </p>
                                                    <select class="form-select mb-4" name="type">
                                                        @if($item->type == 1)
                                                        <option>BUG_FIX</option>
                                                        <option>NEW_PATCH</option>
                                                        @else
                                                        <option>NEW_PATCH</option>
                                                        <option>BUG_FIX</option>
                                                        @endif
                                                    </select>
                                                    <!--.....................................-->
                                                    <p>Description </p>
                                                    <textarea class="form-control mb-4" name="text">{{$item->text}}</textarea>
                                                    <!--.....................................-->
                                                    <p>Pick Release Date </p>
                                                    <input type="date" name="date" class="form-control mb-4" value="{{$item->date->format('d.m.Y')}}">
                                                    <!--.....................................-->
                                                    <p>Attach the Ticket Link </p>
                                                    <textarea class="form-control mb-4" name="link">{{implode(" #", array_column($item->patchNoteLink->toArray(), 'link'))}}</textarea>
                                                    <!--.....................................-->
                                                    <p>Tags </p>
                                                    <input class="form-control mb-4" name="tag" id="tagFilterUpdate{{$item->patch_note_id}}" value="{{$item->patchNoteTags->pluck('name')->map(function($tag) { return '#' . $tag; })->implode(' ')}}">

                                                    @foreach($tag as $items)
                                                        <a class="btn btn-outline-primary bi-tags mb-1" onclick="tagUpdate(this, {{$item->patch_note_id}})">{{$items['name']}}</a>
                                                    @endforeach
                                                    <!--.....................................-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" form="update_form" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" onclick="submitUpdate()">Save Patch Note</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{route('delete', $item->patch_note_id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button style="font-size: 20px" type="submit" class="btn bi bi-trash text-danger"></button>
                                </form>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    <!--...............................................................................................-->
    <script>

        //TODO:CREATE İŞLEMİ
        //  burada seçtiğim tagların başına '#' işareti koyup arasında boşluk bırakmıyorum
        //  bir sonraki tag seçildiğinde ise diğeriyle arasına boşluk bırakıyorum.
        function addTag(element) {
            let tagInput = document.getElementById("tagInput");
            let currentValue = tagInput.value;
            if (currentValue.length > 0) {
                tagInput.value = currentValue + " " + "#" + element.innerText.trim();
            } else {
                tagInput.value = "#" + element.innerText.trim();
            }
        }
        //  kullanıcı her space bastığında  '#' işareti koyup boşluk bırakacak.
        document.getElementById("tagInput").addEventListener("keyup", function(event) {
            let currentValue = this.value;
            if (event.code === "Space" && currentValue.slice(-1) !== "#") {
                this.value = currentValue + "#";
            }
        });
        //  bu kodu yazmamın sebebi ise tagı tıkladığım anda create rotasına gidiyordu bu kod ile engelledik
        document.querySelector("#create_form").addEventListener("submit", function(event) {
            event.preventDefault();
        });
        //  burada engellenen submit butonunu bu kod ile aktif hale getirdik.
        document.querySelector("#create_form[type='submit']").addEventListener("click", function() {
            document.querySelector("#create_form").submit();
        });
        function submitForm() {
            document.querySelector("#create_form").submit();
        }

        // create işlemi sırasında bugünün tarihi otomatik olarak gelmesini sağlayan js kodu

        let todayDate = new Date().toISOString().substring(0, 10);
        document.getElementById('today').value = todayDate;



        //TODO:UPDATE İŞLEMİ
        function tagUpdate(element, id) {
            let tagInput = document.getElementById("tagFilterUpdate" + id);
            let currentValue = tagInput.value;
            if (currentValue.length > 0) {
                tagInput.value = currentValue + " " + "#" + element.innerText.trim();
            } else {
                tagInput.value = "#" + element.innerText.trim();
            }
        }

        document.getElementById("tagFilterUpdate2").addEventListener("keyup", function(event) {
            let currentValue = this.value;
            if (event.code === "Space" && currentValue.slice(-1) !== "#") {
                this.value = currentValue + "#";
            }
        });

        document.querySelector("#update_form").getElementById("submit", function(event) {
            event.preventDefault();
        });

        document.querySelector("#update_form[type='submit']").addEventListener("click", function() {
            document.querySelector("#update_form").submit();
        });

        function submitUpdate() {
            document.querySelector("#update_form").submit();
        }











        // TODO: İNDEX ANASAYFAMIZDA Kİ TAGLARIN KONTROLÜ

        function addTagFilter(element) {
            let tagInput = document.getElementById("tagFilterInput");
            let currentValue = tagInput.value;
            if (currentValue.length > 0) {
                tagInput.value = currentValue + " " + "#" + element.innerText.trim();
            } else {
                tagInput.value = "#" + element.innerText.trim();
            }
        }

        let tagFilterInput = document.getElementById("tagFilterInput");
        let chosenOnesButton = document.getElementById("chosenOnes");

        tagFilterInput.addEventListener("keydown", function(event) {
            if (event.keyCode === 32 && this.value.slice(-1) !== "#") {
                this.value += " #";
                event.preventDefault();
            }
        });

        chosenOnesButton.addEventListener("click", function(event) {
            event.preventDefault();
        });


    </script>
@endsection
