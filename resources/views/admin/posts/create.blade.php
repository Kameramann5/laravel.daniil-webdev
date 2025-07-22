@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создание статьи </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание статьи</h3>
            </div>
            <form role="form" method="post" action="{{admin_route('posts.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Название"

                         >
                    </div>

                    <div class="form-group">
                        <label for="description">Цитата</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Цитата ..."
                                  id="description" rows="5" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Контент</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Контент ..." id="content" rows="5" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                            @foreach($categories as $k=> $v)

                            <option value="{{$k}}">{{$v}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Теги</label>
                        <select name="tags[]"  class="select2" multiple="multiple" data-placeholder="Выбор тегов" id="tags" style="width: 100%;">
                            @foreach($tags as $k=> $v)
                                <option value="{{$k}}">{{$v}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input" >
                                <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        </div>
        </div>
        </div>
        </section>
        <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
