@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $customer->name }}
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('customers.update', $customer->id) }}">
                        @csrf
                        @method('PUT')
                        @include('flash::message')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') ?? $customer->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="identification_type" class="col-md-4 col-form-label text-md-right">Documento</label>

                            <div class="col-md-6">
                                <select id="identification_type" class="form-control @error('identification_type') is-invalid @enderror"
                                    name="identification_type" required>
                                    <option value="{{ \App\Customer::ID_TYPE_CPF }}" {{ $customer->identification_type === \App\Customer::ID_TYPE_CPF ? 'selected' : ''}}>CPF</option>
                                    <option value="{{ \App\Customer::ID_TYPE_RG }}" {{ $customer->identification_type === \App\Customer::ID_TYPE_RG ? 'selected' : ''}}>RG</option>
                                </select>

                                @error('identification_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="identification_number" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <input id="identification_number" type="text" class="form-control @error('identification_number') is-invalid @enderror"
                                    name="identification_number" value="{{ old('identification_number') ?? $customer->identification_number }}" placeholder="Número do documento" required>

                                @error('identification_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') ?? $customer->email }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
