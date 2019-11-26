@extends('layouts.main')

@section('content')
    <h2>Vos Requêtes</h2>
    <div style = "text-align:right"><a class="btn btn-primary" href="{{route("issue.create")}}">{{__("general.add")}}</a></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ __('product.error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($issues->count() == 0)
        <h2>Aucune demande pour l'instant</h2>
    @else
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Demandeur</th>
            <th scope="col">Fournisseur</th>
            <th scope="col">Date</th>
            <th scope="col">Résolu</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>


        @foreach($issues as $issue)
            <tr>

                <td>{{$issue->code}}</td>
                <td>{{$issue->author->name}}</td>
                <td>{{$issue->supplier->name}}</td>
                <td>{{date_format(date_create($issue->date_issue),'Y-m-d')}}</td>
                <td><input type="checkbox" disabled {{($issue->resolved) ? 'checked' : ''}}/> </td>
                <td><a href = "{{ url('supplier/product/'.$issue->number.'/edit') }}">{{__("general.details")}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$issues->links()}}
    @endif
@endsection
