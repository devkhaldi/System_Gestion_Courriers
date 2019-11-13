@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                        <table class="table">
                            <thead class="thead-dark">
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
                                    <a href="#">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

        </div>
    </div>




@endsection