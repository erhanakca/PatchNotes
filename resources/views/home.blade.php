@extends('layout.app')
@section('content')

    <div class="container mt-4">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand text-body-secondary">Patch Notes</a>
                <form class="d-flex" action="#">
                    <button class="btn btn-success" type="submit">Add New Patch Note</button>
                </form>
            </div>
        </nav>

        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" id="tarih" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
            </div>

            <script>
                $( function() {
                    $("#tarih").datepicker();
                } );
            </script>



    </div>




@endsection
