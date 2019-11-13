@extends('layouts.admin')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="container-fluid">
        <div class="col-md-12">
            <div class="delimiter "><span class="text">Création d'un nouveau courrier</span></div>
        </div>
        <div class="col-md-12">
        <div class="card" id="create_courrier_container">
                
            <div class="card-body">
                
                <form class="forms-sample"  action="{{ url('courrier/store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="exampleInputName1">Numéro du courrier</label>
                        <input type="text" name="num" class="form-control" placeholder="Numéro du courrier">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Titre du courrier</label>
                        <input type="text" name="titre" class="form-control"  placeholder="Titre du courrier">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Objet</label>
                        <textarea class="form-control" name="objet" rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Type du courrier</label>
                        <input type="text" name="type" class="form-control"  placeholder="Titre du courrier">
                    </div>
                    <div class="form-group">
                        <label>Choix des fichiers du courrier</label>
                        <input type="file" name="fichier" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Emetteur du courrier</label>
                        <input type="text" class="form-control" name="emetteur"  placeholder="Emetteur">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @for($i=0 ; $i< count($services)/2 ; $i++)
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="services[]" value="{{ $services[$i]->id }}" >
                                        {{ $services[$i]->nom }}
                                        <i class="input-helper"></i></label>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                @for($i=count($services)/2 ; $i< count($services) ; $i++)
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="services[]" value="{{ $services[$i]->id }}">
                                            {{ $services[$i]->nom }}
                                            <i class="input-helper"></i></label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Choix des pièces jointes</label>
                        <input type="file" name="piecejointe[]" multiple class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        
                    </div>
                    </div>
                    

                    <button type="submit" class="btn btn-primary mr-2 ">Enregistrer</button>
                    <button class="btn btn-light ">Retour</button>
                </form>
                
            </div>
        </div>
        </div>
    </div>
    </div>
    
@endsection
     