@extends('layouts.main')

@section('content')
    <h2>Utilisateurs</h2>
    <div style = "text-align:right"><a class="btn btn-primary" href="{{route("product.create")}}">{{__("general.add")}}</a></div>
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
    <table class="table">
        <thead>
        <tr>
           <th scope="col">{{__("profile.Name")}}</th>
            @admin
            <th scope="col">{{__("profile.E-Mail Address")}}</th>
            @endadmin
            <th scope="col">{{__("profile.type")}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <form method="post" action="{{route("admin.editUser", ['id'=>$user->id])}}">
                @csrf
                <td><input id="name" name="name" type="text" class="form-control" value="{{$user->name}}" required/></td>
                <td>{{$user->email}}</td>
                <td><select id="type" name="type" class="form-control">
                        @foreach($user->types as $type)
                            <option @if($type->code === $user->type) selected @endif value="{{$type->code}}">{{__("status.".$type->code)}}</option>
                        @endforeach
                    </select> </td>
                <td><button class ="btn btn-primary">{{__("profile.Save")}}</button> <a class = 'btn btn-danger'  href="{{route("admin.deleteUser", ['id'=>$user->id])}}">{{__("product.delete")}}</a></td>
            </form>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
