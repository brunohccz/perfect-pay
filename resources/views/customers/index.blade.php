@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('flash::message')

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Clientes
                    <a class="btn btn-sm btn-primary" href="{{ route('customers.create') }}">
                        Novo cliente
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->identification }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('customers.edit', $customer->id) }}">Editar</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:;"
                                        onclick="confirm('Tem certeza que deseja excluir?') ? $('#delete_{{ $customer->id }}').submit() : null"
                                    >Excluir</a>
                                    <form id="delete_{{ $customer->id }}" method="post" action="{{ route('customers.destroy', $customer->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nenhum cliente cadastrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
