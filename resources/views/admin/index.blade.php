@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="col-md-12">
        <div class="delimiter"><span class="text">Liste des courriers ajoutés</span></div>
    </div>
    <div class="col-md-12">
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Titre</th>
                <th scope="col">Emetteur</th>
                <th scope="col">Date</th>
                <th scope="col">Opérations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courriers as $courrier)
                <tr>
                    <td>{{ $courrier->num }}</td>
                    <td>{{ $courrier->titre }}</td>
                    <td>{{ $courrier->emetteur }}</td>
                    <td>{{ $courrier->created_at->diffForHumans() }}</td>
                    <td>
                        <a class="operation" href="#" @click="getCourrier( {{ $courrier->id }} )" data-toggle="modal" data-target="#courrier" ><i class="ti-layers"></i></a>
                        <a class="operation" href="#" @click="getstatuscourrier( {{ $courrier->id }} )" data-toggle="modal" data-target="#statuscourrier" ><i class="ti-bar-chart-alt"></i></a>
                        <a class="operation" href="#" @click="getCourrier( {{ $courrier->id }} )" data-toggle="modal" data-target="#exampleModalScrollable" ><i class="ti-pencil-alt"></i></a>
                        <a class="operation" href="#" @click="getCourrier( {{ $courrier->id }} )" data-toggle="modal" data-target="#exampleModalScrollable" ><i class="ti-trash"></i></a>
                      </td>
                   
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
  </div>
    

    
  <!-- Informations courrier -->
  <div class="modal fade bd-example-modal-lg" id="courrier" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Affichage du contenu de courrier num : @{{ courrier.num }} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="helper-text">Informations du courrier</h4>
              <div class="row courrier_field_container">
                <div class="col-md-4">Numéro</div>
                <div class="col-md-8">
                  @{{ courrier.num }}
                </div>
              </div>
              <div class="row courrier_field_container">
                <div class="col-md-4">Titre</div>
                <div class="col-md-8">
                  @{{ courrier.titre }}
                </div>
              </div>
              <div class="row courrier_field_container">
                <div class="col-md-4">Objet</div>
                <div class="col-md-8">
                  @{{ courrier.objet }}
                </div>
              </div>
              <div class="row courrier_field_container">
                <div class="col-md-4">Emetteur</div>
                <div class="col-md-8">
                  @{{ courrier.emetteur }}
                </div>
              </div>
             
          <h4 class="helper-text">Contenu du corrier</h4>
          <div class="row" id="courrier_image">
          <img v-bind:src="'storage/'+courrier.fichier" class="modal_image"  alt="fichier courrier" width="100%"> 
          </div>
          
          
          <h4 class="helper-text">Pièces jointes</h4>
          <div class="row" v-for="piecejointe in piecejointes" id="courrier_image">
            <img v-bind:src="'storage/'+piecejointe.fichier" class="modal_image" alt="fichier courrier" width="100%"> 
          </div>
          
        </div>
        <!-- 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        -->
      </div>
    </div>
  </div>

  
  <!-- Informations courrier -->
  <div class="modal fade bd-example-modal-lg" id="statuscourrier" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Status du courrier num : @{{ courrier.num }} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="helper-text">Status du courrier</h4>
              
          
              
          <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th scope="col">Service</th>
                <th scope="col">Status</th>
                <th scope="col">Employe</th>
                <th scope="col">Status</th>
                
            </tr>
            </thead>
            <tbody>
                <tr v-for="service in services">
                    <td>@{{service.nom}}</td>
                      <td>@{{service.status}}</td>
                      <td>-</td>
                      <td>-</td>
                </tr>
              <tr v-for="employe in employes">
              <td>@{{employe.service}}</td>
                <td>@{{employe.statusenvoi}}</td>
                <td>@{{employe.name}}</td>
                <td>@{{employe.status}}</td>
              </tr>
            </tbody>
        </table>
          
          
        </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  
  
  
  </div>



@endsection