@extends('layout.app')
@section('content')


        <nav class="navbar bg-body-tertiary m-sm-3">
            <div class="container-fluid">
                <a class="navbar-brand text-body-secondary text-body-emphasis"><i class="bi bi-journals m-lg-2"></i>Patch Notes</a>
                <form class="d-flex" action="#">
                    <button class="btn btn-success" type="submit">Add New Patch Note</button>
                </form>
            </div>
        </nav>



        <div class="row mt-5 m-sm-3">
            <div class='col-sm-3'>
                <footer class="text-body-secondary mb-3">Pick Release Date</footer>
                <div class="form-group">
                    <form action="#">
                    <div class='input-group date mb-3'>
                        <input type='date' class="form-control" placeholder="dd.mm.yyyy" />
                    </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="submit" class="btn btn-success">Reset All Filters</button>
                    </form>

                </div>
            </div>






        </div>




@endsection
