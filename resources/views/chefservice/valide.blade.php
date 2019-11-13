@extends('layouts.chefservice')
@section('content')

  @if (count($employees))
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="delimiter"><span class="text">Choix des récépteurs du courrier</span></div>
    </div>
    <div class="col-md-12">
      <form action="{{url('courrier/savevalidation/'.$courrier_id)}}" method="post">
        {{ csrf_field() }}
        <table class="table table-striped">
            <thead class="thead-light">
                <th>Image</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Envoyer ?</th>
            </thead>
            <tbody>
              @foreach($employees as $employee)
                  <tr>
                      <td class="td-user">
                        @if($employee->photo != null)
                        <img src="{{ asset('storage/'.$employee->photo) }}" alt="">
                        @else
                        <img src="{{ asset('images/faces/face1.jpg') }}" alt="">
                        @endif
                        
                      </td>
                      <td class="td-user">{{ $employee->name }}</td>
                      <td class="td-user">{{ $employee->email }}</td>
                      <td class="td-user"> 
                          <input type="checkbox" name="users[]" class="checkuser" value="{{ $employee->id }}" >
                      </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
        <hr>
        <button type="submit" class="btn btn-primary mr-2 ">Enregistrer</button>
        <a href="{{url('/')}}" class="btn btn-light " style="margin-left:-5px">Retour</a>
      </form>
    </div>
  </div>
  
  @else
      <h3 style="margin-top:200px" align="center">Aucun utilisateur trouvé</h3>
  @endif
    
    
@endsection