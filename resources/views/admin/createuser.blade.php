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
                    <!-- display errors -->
                    @if (count($errors->all()))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>        
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                    </div>    
                    @endif
                    
                <form class="forms-sample"  action="{{ url('user/store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="exampleInputName1">Nom d'utilisateur</label>
                        <input type="text" name="name" class="form-control" placeholder="Nom d'utilisateur">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Email</label>
                        <input type="text" name="email" class="form-control"  placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Mot de passe</label>
                        <input type="password" name="password" class="form-control"  placeholder="Mot de passe">
                    </div>

                    <div class="form-group">
                        <label for="">Confirmation de mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirmation de mot de passe">
                    
                    </div>
                    
                    <div class="form-group">
                        <label>Cin d'employé</label>
                        <input type="text" class="form-control" name="cin"  placeholder="Cin d'employe">
                    </div>

                    
                    <div class="form-group">
                        <label>Service</label>
                           <select class="form-control" name="service">
                               @foreach ($services as $service)
                                    <option value="{{$service->id}}">{{$service->nom}}</option>   
                               @endforeach
                                
                          </select>
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
     