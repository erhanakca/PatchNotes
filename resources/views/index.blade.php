@extends('layout.app')
@section('content')

    <!--...............................................................................................-->
    <nav class="navbar bg-body m-sm-3" xmlns="http://www.w3.org/1999/html">
            <div class="container-fluid">
                <a class="navbar-brand text-body-secondary text-body-emphasis"><i class="bi bi-journals m-lg-2"></i>Patch Notes</a>
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
                                    <input type="date" name="date" class="form-control mb-4">
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
                    <div class='text-area mb-3'>
                        <input type="date" name="date" class="form-control"/>
                    </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="reset" class="btn btn-success">Reset All Filters</button>
                    </form>
                </div>
                <p class="text-body-secondary mt-3"><br>Filter By Tags</p>
                <hr>
                    <form  action="{{route('tagFilter')}}" method="POST" id="tagFilterForm">
                    @csrf
                    @method('GET')
                    @foreach($tag as $item)
                        <button style="background-color: lightblue" class="btn btn-outline-primary bi-tags mb-1"> {{$item['name']}}</button>
                    @endforeach
                        <textarea type="text" name="tags" class="form-control mb-4 mt-5"></textarea>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" form="tagFilterForm">Filter</button>
                        <button type="reset" class="btn btn-success">Reset All Filters</button>
                    </div>
                    </form>
            </div>
     <!--SAĞ KOLON-->
            <div class='col-sm-9'>
                <p  style="color: gray; font-size: 40px">Release Notes</p>
                <h6 class="text-body-secondary mb-3">This patch note does not belong to any institution.</h6>
                <hr>

                {{$current_date = null}}
                @foreach($patch_note as $item)
                    @if($item->type == 1)
                        @if($current_date != $item->date->format('d-m-Y'))
                            <p class="alert alert-primary fs-4 d-md-flex">{{$item->date->format('d-m-Y')}}</p>
                        @else
                             {{$current_date = $item->date->format('d-m-Y')}}
                        @endif
                        <div class="bg-light p-3 rounded mb-2" style="">
                            <p class="fs-5 text-danger">Bugfix</p>
                            <p class="fs-7">{{$item->text}}</p>
                            @foreach($item->links as $link)
                            <a href="{{$link->url}}" class="btn bi bi-box-arrow-up-right text-info"> {{$link->link}}</a>
                            @endforeach
                            <br>
                            <br>
                            @foreach($item->patchNoteTags as $tags)
                            <button style="background-color: lightblue" class="btn btn-outline-primary bi-tags mb-1" disabled> {{$tags['name']}}</button>
                            @endforeach
                            <br>
                            <br>
                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <form action="{{route('update', $item->patch_note_id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button style="font-size: 20px" type="button" class="btn bi bi-pencil text-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$item->patch_note_id, $link->patch_note_link_id}}"></button>
                                    <div class="modal fade" id="updateModal{{$item->patch_note_id, $link->patch_note_link_id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><i class="bi bi-journals m-lg-2"></i>Update</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!--.....................................-->
                                                    <p class="">Patch Note Type </p>
                                                    <select class="form-select mb-4" name="type" id="type-select">
                                                        <option>BUG_FIX</option>
                                                        <option>NEW_PATCH</option>
                                                    </select>
                                                    <!--.....................................-->
                                                    <p>Description </p>
                                                    <textarea class="form-control mb-4" name="text">{{$item->text}}</textarea>
                                                    <!--.....................................-->
                                                    <p>Pick Release Date </p>
                                                    <input type="date" name="date" class="form-control mb-4" value="{{$item->date->format('d-m-Y')}}">
                                                    <!--.....................................-->
                                                    <p>Attach the Ticket Link </p>
                                                    <textarea class="form-control mb-4" name="link">{{implode("\n", $item->links->pluck('link')->toArray())}}</textarea>
                                                    <!--.....................................-->
                                                    <p>Tags </p>
                                                    <input class="form-control mb-4" name="tag" id="tagInput">
                                                    @foreach($tag as $items)
                                                        <button class="btn btn-outline-primary bi-tags mb-1" onclick="addTag(this)">  {{$items['name']}}</button>
                                                    @endforeach
                                                    <!--.....................................-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="savePatchNote">Save Patch Note</button>
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

                {{$current_date = null}}
                @foreach($patch_note as $item)
                    @if($item->type == 0)
                        @if($current_date != $item->date->format('d-m-Y'))
                            <p class="alert alert-primary fs-4 d-md-flex">{{$item->date->format('d-m-Y')}}</p>
                        @else
                            {{$current_date = $item->date->format('d-m-Y')}}
                        @endif
                        <div class="bg-light p-3 rounded mb-2" style="">
                            <p class="fs-5 text-primary">New Patch</p>
                            <p class="fs-7">{{$item->text}}</p>
                            @foreach($item->links as $link)
                                <a href="{{$link->url}}" class="btn bi bi-box-arrow-up-right text-info"> {{$link->link}}</a>
                            @endforeach
                            <br>
                            <br>
                            @foreach($item->patchNoteTags as $tags)
                                <button style="background-color: lightblue" class="btn btn-outline-primary bi-tags mb-1" disabled> {{$tags['name']}}</button>
                            @endforeach
                            <br>
                            <br>
                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <form action="{{route('update', $item->patch_note_id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button style="font-size: 20px" type="button" class="btn bi bi-pencil text-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$item->patch_note_id, $link->patch_note_link_id}}"></button>
                                    <div class="modal fade" id="updateModal{{$item->patch_note_id, $link->patch_note_link_id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
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
                                                        <option >NEW_PATCH</option>
                                                        <option >BUG_FIX</option>
                                                    </select>
                                                    <!--.....................................-->
                                                    <p>Description </p>
                                                    <textarea class="form-control mb-4" name="text">{{$item->text}}</textarea>
                                                    <!--.....................................-->
                                                    <p>Pick Release Date </p>
                                                    <input type="date" name="date" class="form-control mb-4">
                                                    <!--.....................................-->
                                                    <p>Attach the Ticket Link </p>
                                                    <textarea class="form-control mb-4" name="link">{{implode("\n", $item->links->pluck('link')->toArray())}}</textarea>
                                                    <!--.....................................-->
                                                    <p>Tags </p>
                                                    <input class="form-control mb-4" name="tag" id="tagInput">
                                                    @foreach($tag as $items)
                                                        <button class="btn btn-outline-primary bi-tags mb-1" onclick="addTag(this)">  {{$items['name']}}</button>
                                                    @endforeach
                                                    <!--.....................................-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="savePatchNote">Save Patch Note</button>
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
            </div>
        </div>
    <!--...............................................................................................-->
    <script>
        // TODO: İNDEX ANASAYFAMIZDA Kİ TAGLARIN KONTROLÜ








        // TODO: CREATE İŞLEMİ MODAL İÇERİSİ...

        // todo: burada seçtiğim tagların başına '#' işareti koyup arasında boşluk bırakmıyorum
        // todo: bir sonraki tag seçildiğinde ise diğeriyle arasına boşluk bırakıyorum.
        function addTag(element) {
            let tagInput = document.getElementById("tagInput");
            let currentValue = tagInput.value;
            if (currentValue.length > 0) {
                tagInput.value = currentValue + " " + "#" + element.innerText.trim();
            } else {
                tagInput.value = "#" + element.innerText.trim();
            }
        }

        // todo: kullanıcı her tag girdiğinde başına '#' işareti koyup boşluk bırakacak.
        document.getElementById("tagInput").addEventListener("keyup", function(event) {
            let currentValue = this.value;
            if (event.code === "Space" && currentValue.slice(-1) !== "#") {
                this.value = currentValue + "#";
            }
        });

        // todo: bu kodu yazmamın sebebi ise tagı tıkladığım anda create rotasına gidiyordu bu kod ile engelledik
        document.querySelector("#create_form").addEventListener("submit", function(event) {
            event.preventDefault();});

        // todo: burada engellenen submit butonunu bu kod ile aktif hale getirdik.
        document.querySelector("#create_form[type='submit']").addEventListener("click", function() {
            document.querySelector("#create_form").submit();
        });

    </script>
@endsection
