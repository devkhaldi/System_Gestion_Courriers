@extends('layouts.chefservice')
@section('content')

    <div class="container-fluid">
      <div class="col-md-12">
          <div class="delimiter"><span class="text">Courriers pas encore validés</span></div>
      </div>
      <div class="col-md-12">
          <table class="table table-striped" style="margin-bottom: 40px">
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
              @foreach($courriersnonvalide as $courrier)
                  <tr>
                      <td>{{ $courrier->num }}</td>
                      <td>{{ $courrier->titre }}</td>
                      <td>{{ $courrier->emetteur }}</td>
                      <td>{{ $courrier->created_at }}</td>
                      <td>
                          <a href="#" @click="getCourrier( {{ $courrier->id }} )" data-toggle="modal" data-target="#exampleModalScrollable"><i class="ti-layers"></i></a>
                      </td>
                     
                  </tr>
              @endforeach
              </tbody>
          </table>      
      </div>
      <div class="col-md-12">
          <div class="delimiter"><span class="text">Courriers validés</span></div>
      </div>
      <div class="col-md-12">
          <table class="table table-striped" >
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
              @foreach($courriersvalide as $courrier)
                  <tr>
                      <td>{{ $courrier->num }}</td>
                      <td>{{ $courrier->titre }}</td>
                      <td>{{ $courrier->emetteur }}</td>
                      <td>{{ $courrier->created_at }}</td>
                      <td>
                          <a href="#" @click="getCourrier( {{ $courrier->id }} )" data-toggle="modal" data-target="#exampleModalScrollable"><i class="ti-layers"></i></a>
                      </td>
                     
                  </tr>
              @endforeach
              </tbody>
          </table>
          
      </div>
    </div>

  
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
          <div class="row" v-for="piecejointe in piecejointes" >
            <img v-bind:src="'storage/'+piecejointe.fichier" class="modal_image" alt="fichier courrier" width="100%"> 
          </div>
          
        </div>
        
        <div class="modal-footer" v-if="status == 'nonvalide'">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <a v-bind:href="'courrier/valider/'+courrier.id" class="btn btn-primary">Vérifier</a>
        </div>
      
      </div>
    </div>
  </div>
@endsection