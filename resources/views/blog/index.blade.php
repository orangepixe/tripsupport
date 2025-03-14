@extends('layouts.app')
@section('page-title')
    {{ __('Blog') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{ __('Blog') }}
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>{{ __('Blog List') }}</h5>
                        </div>
                        @if (Gate::check('create blog'))
                            <div class="col-auto">
                                <a class="btn btn-secondary customModal" href="#" data-size="lg"
                                    data-url="{{ route('blog.create') }}" data-title="{{ __('Create Blog') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>{{ __('Create Blog') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Blog') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>

                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ asset('/storage/upload/blog/' . $blog->thumbnail) }}"
                                                    target="_blank" class="img-wrap">
                                                    <img class="wid-50 rounded"
                                                        src="{{ asset('/storage/upload/blog/' . $blog->thumbnail) }}"
                                                        alt="">
                                                </a>
                                                <div class="media-body ms-3">{{ $blog->title }}</div>
                                            </div>
                                        </td>
                                        <td>{{ !empty($blog->categories) ? $blog->categories->category : '-' }} </td>
                                        <td>
                                            @if ($blog->status == 1)
                                                <span
                                                    class="badge text-bg-success">{{ \App\Models\Blog::$status[$blog->status] }}</span>
                                            @else
                                                <span
                                                    class="badge text-bg-danger">{{ \App\Models\Blog::$status[$blog->status] }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['blog.destroy', $blog->id]]) !!}
                                                @can('edit blog')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('blog.edit', $blog->id) }}"
                                                        data-title="{{ __('Edit Blog') }}"> <i data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete blog')
                                                    <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Detete') }}" href="#"> <i
                                                            data-feather="trash-2"></i></a>
                                                @endcan
                                                {!! Form::close() !!}
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
