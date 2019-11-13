@extends('layouts.admin')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <label>Pieces jointes</label>
                <div id="dropzone1" class="multi-uploader-cs">
                  <!-- 
                <form action="{{ url('piecejointe/'.$courrier_id) }}" method="post" enctype="multipart/form-data" class="dropzone dropzone-nk needsclick" id="my-awesome-dropzone">
                        <div class="dz-message needsclick download-custom">
                            <i class="notika-icon notika-cloud"></i>
                            <h2>Drop files here or click to upload.</h2>
                            <p><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                            </p>
                        </div>
                    </form>
                  -->
                    <form action="{{ url('piecejointe/'.$courrier_id) }}" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">@csrf</form>
                    <br>
                    <a href="{{ url('/') }}" type="button" class="btn btn-primary mr-2 ">Ajouter le courrier</a>
                </div>
            </div>
        </div>
    </div>

@endsection
     