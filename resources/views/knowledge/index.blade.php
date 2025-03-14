@extends('layouts.app')
@section('page-title')
    {{ __('Knowledge Article') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{ __('Knowledge Article') }}
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
                            <h5>{{ __('Knowledge Article List') }}</h5>
                        </div>
                        @if (Gate::check('create knowledge article'))
                            <div class="col-auto">
                                <a class="btn btn-secondary customModal" href="#" data-size="lg"
                                    data-url="{{ route('knowledge-article.create') }}"
                                    data-title="{{ __('Create Article') }}"> <i
                                        class="ti ti-circle-plus align-text-bottom"></i>{{ __('Create Article') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($knowledges as $knowledge)
                                    <tr>
                                        <td>
                                            {{ $knowledge->title }}
                                        </td>
                                        <td>{{ !empty($knowledge->categories) ? $knowledge->categories->category : '-' }} </td>

                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['knowledge-article.destroy', $knowledge->id]]) !!}
                                                @can('edit knowledge article')
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('knowledge-article.edit', $knowledge->id) }}"
                                                        data-title="{{ __('Edit Knowledge') }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete knowledge article')
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
