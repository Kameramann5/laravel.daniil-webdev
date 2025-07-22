@extends('layouts.layout')

@section('title','Markedia - Marketing Blog Template :: Home')

@section('header')
    <section id="cta" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2>A digital marketing blog</h2>
                    <p class="lead"> Aenean ut hendrerit nibh. Duis non nibh id tortor consequat cursus at mattis felis.
                        Praesent sed lectus et neque auctor dapibus in non velit. Donec faucibus odio semper risus
                        rhoncus rutrum. Integer et ornare mauris.</p>
                    <a href="#" class="btn btn-primary">Try for free</a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="newsletter-widget text-center align-self-center">
                        <h3>Подпишись!</h3>

                        @if(session('success'))
                            <div style="color: green;">{{ session('success') }}</div>
                        @endif

                        <form action="/email-form" method="POST" class="form-inline">
                            @csrf

                            <input type="email" name="email" class="form-control" placeholder="Введите email" required>
                            <input type="submit" value="Подписаться" class="btn btn-default btn-block"/>
                        </form>
                        @if($errors->any())
                            <div style="color: red;">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div><!-- end newsletter -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @foreach($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{route('posts.single',['slug'=>$post->slug])}}" title="">
                            <img src="{{$post->getImage()}}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                            class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                            class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a>
                                </li>
                            </ul>
                        </div><!-- end post-sharing -->
                        <h4><a href="{{route('posts.single',['slug'=>$post->slug])}}" title="">
                                {{$post->title}}
                            </a></h4>
                        <?php //для рендера html тегов ?>
                        <div>
                    {!! $post->description !!}
                        </div>
                        <small><a href="{{route('categories.single',['slug'=>$post->category->slug])}}" title="">{{$post->category->title}}</a></small>
                        <small>{{$post->getPostDate()}}</small>

                        <small><i class="fa fa-eye"></i> {{ $post->views}}</small>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->
                <hr class="invis">
            @endforeach
        </div>
    </div>
    <hr class="invis">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $posts->links()  }}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->






    <h2>  <b>  Вывести через ajax статьи</b>  </h2>
    <div class="page-wrapper">
        <div class="blog-custom-build rest-api-articles">



        </div>
    </div>


@endsection



