@extends('adminlte::page')
@section('title', 'CẤU HÌNH CHUNG')
@section('content_header')
    <h1>CẤU HÌNH CHUNG</h1>
@stop
@section('plugins.Select2', true)
@section('content')
<x-adminlte-alert>
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Môn học</h3>
                  <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form  action="{{ route('quiz.submit-add') }}" method="POST">    
                        @csrf 
                    <x-adminlte-input name="input-add-topic" label="Thêm môn học" placeholder="Thêm môn học..." igroup-size="md">
                        <x-slot name="appendSlot">
                            <x-adminlte-button type="submit" theme="outline-danger" label="Thêm" name="btn-add-topic" value="add-topic"/>
                        </x-slot>                      
                    </x-adminlte-input>
                    </form>
                    @foreach ($topic as $item)
                    @if ($item->parent > 0 )
                    <form  action="{{ route('quiz.submit-topic') }}" method="POST"> 
                        @csrf
                        <p class="mb-2 d-flex justify-content-between">
                            <span>{{ $item->name }}</span>
                            <span>                                
                                    <x-adminlte-button class="btn-sm" type="submit" label="Sửa" theme="success" icon="fas fa-edit" value="{{$item}}" name="edit"/>
                                    <x-adminlte-button class="btn-sm" type="submit" label="Xóa" theme="outline-danger" icon="fas fa-trash" value="{{$item}}" name="delete"/>                                       
                            </span>                            
                        </p>
                    </form>
                    @endif
                    @endforeach         
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Khối lớp</h3>
                  <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form  action="{{ route('quiz.submit-add') }}" method="POST">    
                        @csrf 
                    <x-adminlte-input name="input-add-class" label="Thêm khối lớp" placeholder="Thêm khối lớp..." igroup-size="md">
                        <x-slot name="appendSlot">
                            <x-adminlte-button type="submit" theme="outline-danger" label="Thêm" name="btn-add-class" value="add-class"/>
                        </x-slot>                      
                    </x-adminlte-input>
                    </form>
                    @foreach ($class as $item)
                    @if ($item->parent > 0 )
                    <form  action="{{ route('quiz.submit-class') }}" method="POST">    
                        @csrf 
                        <p class="mb-2 d-flex justify-content-between">
                            <span>{{ $item->name }}</span>
                            <span>
                                
                                <x-adminlte-button class="btn-sm" type="submit" label="Sửa" theme="success" icon="fas fa-edit" value="{{$item}}" name="edit"/>
                                <x-adminlte-button class="btn-sm" type="submit" label="Xóa" theme="outline-danger" icon="fas fa-trash" value="{{$item}}" name="delete" />                            
                                
                            </span>
                            
                        </p>
                    </form>   
                    @endif
                    @endforeach                  
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</x-adminlte-alert>
<script>
    document.addEventListener('DOMContentLoaded', function(event) {
             // Bắt sự kiện chọn tất cả
   
    });
</script>
@stop

