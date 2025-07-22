@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Статьи </h1>
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

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список статей</h3>

                                  </div>
                <div class="card-body">
                    <a href="{{ admin_route('posts.create')  }}" class="btn btn-primary mb-3">Добавить статью</a>
                    <br>
                    <b>ajax добавить статью</b>
                    <form action="">
                        <input type="text" name="title" id="title" placeholder="Название" required>
                        <input type="text" name="description" id="description" placeholder="Цитата" required>
                        <input type="text" name="content" id="content" placeholder="Контент" required>
                        <input type="text" name="category_id" id="category_id" placeholder="id Категории" required>
                        <input type="hidden" name="created_at" id="created_at" value="<?php $currentDateTime = date('Y-m-d H:i:s');
// Выводим дату и время
echo $currentDateTime; ?>" required>
                            <button type="button"  onclick="storeArticle()">Добавить</button>
                    </form>
                    <div id="title-error"></div>

                    <div id="description-error"></div>

                    <div id="content-error"></div>

                    <div id="category_id-error"></div>
                    <div id="post-add-success"></div>
                    <br>
                    <b>ajax список статей</b>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Наименование</th>
                                <th>Категория</th>

                                <th >Дата</th>
                                <th >Actions</th>
                            </tr>
                            </thead>
                            <tbody class="rest-api-articles">

                            </tbody>
                        </table>
                    </div>
                    <b>php статьи</b>

                    @if (count($posts))

                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Наименование</th>
                            <th>Категория</th>
                            <th >Теги</th>
                            <th >Дата</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->title}}</td>
                            <td>{{$post->tags->pluck('title')->join(', ')}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>
                                <a href="{{admin_route('posts.edit',['post'=>$post->id])}}"
                                   class="btn"><i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{admin_route('posts.destroy',['post'=>$post->id])}}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    @else
                    <p>Статей пока нет</p>
                        @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$posts->links()}}


                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="id-modal-input"  value="">

                                <div class="form-group">
                                    <label for="title-modal-input">Название</label>
                                    <input type="text" class="form-control" id="title-modal-input" name="title" value="" placeholder="Название">
                                </div>
                                <div class="form-group">
                                    <label for="category_id-modal-input">id Категории</label>
                                    <input type="text" class="form-control" id="category_id-modal-input"  value="" placeholder="Название">
                                </div>
                                <div class="form-group">
                                    <label for="content-modal-input">Контент</label>
                                    <input type="text" class="form-control" id="content-modal-input" name="content" value="" placeholder="Контент">
                                </div>
                                <div class="form-group">
                                    <label for="description-modal-input">Цитата</label>
                                    <input type="text" class="form-control" id="description-modal-input" name="description" value="" placeholder="Цитата">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">

                                <button type="button" class="btn btn-primary" onclick="updateArticle()">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="modal-delete">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-delete">Удалить статью? </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="id-modal-delete-input"  value="">
                                <span id="delete-title"></span>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                <button type="button" class="btn btn-danger" onclick="deleteArticle()">Удалить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
        <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
