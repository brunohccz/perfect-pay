@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Venda #{{ $sale->id }}
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('sales.update', $sale->id) }}">
                        @csrf
                        @method('PUT')
                        @include('flash::message')
                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

                            <div class="col-md-6">
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required autofocus>
                                    @forelse ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ optional($sale->customer)->id === $customer->id ? 'selected' : ''  }}>{{ $customer->name }}</option>
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
                                    @forelse ($products as $product)
                                        <option value="{{ $product->id }}" {{ $sale->product->id === $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
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
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? $sale->quantity }}" required>

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
                                <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') ?? $sale->discount }}" required>

                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="{{ \App\Sale::STATUS_SOLD }}" {{ $sale->status === \App\Sale::STATUS_SOLD ? 'selected' : ''}}>Vendido</option>
                                    <option value="{{ \App\Sale::STATUS_CANCELED }}" {{ $sale->status === \App\Sale::STATUS_CANCELED ? 'selected' : ''}}>Cancelado</option>
                                    <option value="{{ \App\Sale::STATUS_REFUNDED }}" {{ $sale->status === \App\Sale::STATUS_REFUNDED ? 'selected' : ''}}>Devolvido</option>
                                </select>

                                @error('status')
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
