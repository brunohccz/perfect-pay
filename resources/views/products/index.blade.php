@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('flash::message')

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Produtos
                    <a class="btn btn-sm btn-primary" href="{{ route('products.create') }}">
                        Novo produto
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ \Str::limit($product->description, 35) }}</td>
                                <td>R$ {{ $product->price }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('products.edit', $product->id) }}">Editar</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:;"
                                        onclick="confirm('Tem certeza que deseja excluir?') ? $('#delete_{{ $product->id }}').submit() : null"
                                    >Excluir</a>
                                    <form id="delete_{{ $product->id }}" method="post" action="{{ route('products.destroy', $product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nenhum produto cadastrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
