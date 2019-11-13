@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">INFORMATIONS DU COURRIER</div>

                    <div class="card-body">

                        <form action="{{ url('courrier/store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label for="">Num</label>
                                <input type="text" class="form-control" name="num">
                                <label for="">Titre</label>
                                <input type="text"for="" class="form-control" name="titre">
                                <label for="">Objet</label>
                                <textarea class="form-control" rows="6" class="form-control" name="objet"></textarea>
                                <label for="">Fichier</label>
                                <input type="file" class="form-control" name="fichier">
                                <label for="">Emetteur</label>
                                <input type="text" class="form-control" name="emetteur">

                            <label for="">CHOIX DES SERVICES</label>
                            <div class="form-group">
                                <div class="form-check"  >
                                    @foreach($services as $service)

                                        <input class="form-check-input" name="services[]" type="checkbox" value="{{ $service->id }}" >
                                        <label class="form-check-label" >
                                            {{ $service->nom }}
                                        </label><br>

                                    @endforeach
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary form-control" style="margin-top:30px !important" >
                        </form>
                    </div>
                 </div>
            </div>
    </div>
@endsection