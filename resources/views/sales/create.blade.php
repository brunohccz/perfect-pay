@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Nova venda
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('sales.store') }}">
                        @csrf
                        @include('flash::message')
                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

                            <div class="col-md-6">
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required autofocus>
                                    <option selected disabled>Selecione</option>
                                    @forelse ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @empty
                                    @endforelse
                                </select>

                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_id" class="col-md-4 col-form-label text-md-right">Produto</label>

                            <div class="col-md-6">
                                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                    <option selected disabled>Selecione</option>
                                    @forelse ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @empty
                                    @endforelse
                                </select>

                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantidade</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-md-4 col-form-label text-md-right">Desconto</label>

                            <div class="col-md-6">
                                <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required>

                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Adicionar
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
