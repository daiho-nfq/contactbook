@extends('layouts.app')
@section('title','Update contact')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Update contact</div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="patch" action="{{ route('contacts.update', $contact->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Contact name:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') ?? $contact->name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Contact email:</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') ?? $contact->email}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Contact phone:</label>
                                <input type="number" class="form-control" name="phone" value="{{ old('phone') ?? $contact->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="address">Contact address:</label>
                                <input type="text" class="form-control" name="address" value="{{old('address') ?? $contact->address}}">
                            </div>
                            <button type="submit" class="btn btn-outline-success">Update contact</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
