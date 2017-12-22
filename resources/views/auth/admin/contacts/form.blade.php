@extends('layouts.admin.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Контакт</h3>
        </div>
        <div class="box-body">
            @include('admin.form.name_alias')
        </div>
        <!-- /.box-body -->
    </div>
@endsection