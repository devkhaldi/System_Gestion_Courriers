@extends('layouts.chefservice')
@section('content')

<div class="container-fluid">

  @foreach ($services as $service)
      <div class="col-md-12">
        <div class="delimiter"><span class="text">Employées du service : {{ $service->nom}}</span></div>
      </div>
        <div class="col-md-12">

            <table class="table table-striped">
                <thead class="thead-light">
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Email</th>
                </thead>
                <tbody>
                  @foreach($service->users as $user)
                      <tr>
                          <td class="td-user">
                            @if($user->photo != null)
                            <img src="{{ asset('storage/'.$user->photo) }}" alt="">
                            @else
                            <img src="{{ asset('images/faces/face1.jpg') }}" alt="">
                            @endif
                            
                          </td>
                          <td class="td-user">{{ $user->name }}</td>
                          <td class="td-user">{{ $user->email }}</td>
                          
                      </tr>
                  @endforeach
                </tbody>
            </table>
        </div>


  @endforeach

   

  </div>

@endsection