@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('flash::message')

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Tabela de vendas
                    <a class="btn btn-sm btn-primary" href="{{ route('sales.create') }}">
                        Nova venda
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Desconto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>
                                    @if($sale->customer !== null)
                                        <a href="{{ route('customers.edit', $sale->customer->id) }}" target="_blank">
                                            {{ $sale->customer->name }}
                                        </a>
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $sale->product->id) }}" target="_blank">
                                        {{ $sale->product->name }}
                                        @if($sale->quantity > 1)
                                            ({{ $sale->quantity }})
                                        @endif
                                    </a>
                                </td>
                                <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                <td>R$ {{ $sale->sale_amount }}</td>
                                <td>R$ {{ $sale->discount }}</td>
                                <td>
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between">
                    Resultados das vendas
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Quantidade</th>
                            <th>Valor total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Vendidos</td>
                            <td>{{ $analytics['sold']['count'] }}</td>
                            <td>R$ {{ $analytics['sold']['total'] }}</td>
                        </tr>
                        <tr>
                            <td>Cancelados</td>
                            <td>{{ $analytics['canceled']['count'] }}</td>
                            <td>R$ {{ $analytics['canceled']['total'] }}</td>
                        </tr>
                        <tr>
                            <td>Devoluções</td>
                            <td>{{ $analytics['refunded']['count'] }}</td>
                            <td>R$ {{ $analytics['refunded']['total'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
