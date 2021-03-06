@extends('adminlte::page')

@section('Histórico de movimentação', 'Histórico')

@section('content_header')
    <h1>Histórico</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <form method="POST" action="{{ route('historic.search') }}" class="form form-inline">
                {!! csrf_field() !!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="date" name="date" class="form-control">
                <select name="type">

                    <option value="">Tipo</option>

                    @foreach ($types as $key => $type)

                    <option value="{{ $key }}">{{ $type }}</option>
                    
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </>

        </div>

        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>?Sender?</th>
                    </tr>
                </thead>
                <tbody> 
                    @forelse( $historics as $historic)
                        <tr>
                            <td>{{$historic->id}}</td>
                            <td>{{$historic->date}}</td>
                            <td>{{number_format($historic->amount, 2, ',', '.')}}</td>
                            <td>{{ $historic->type($historic->type) }}</td>
                            <td>
                                @if ($historic->user_id_transaction)
                                    {{ $historic->userSender->name }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>    
                    @empty
                    @endforelse

                </tbody>
            </table>

            @if (isset($dataForm))
                {!! $historics->appends($dataForm)->links() !!}
            @else
                {!! $historics->links() !!}
            @endif
        </div>

    </div>


@stop