@extends('layouts.app')
@section('page-title')
    {{ __('Ticket') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __('Ticket') }}</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="card table-card">
            <div class="card-header">
                <div class="row align-items-center g-2">
                    <div class="col">
                        <h5>{{ __('Ticket List') }}</h5>
                    </div>
                    @if (Gate::check('create ticket'))
                        <div class="col-auto">
                            <a class="btn btn-secondary customModal" href="#" data-size="lg"
                                data-url="{{ route('ticket.create') }}" data-title="{{ __('Create Ticket') }}"> <i
                                    class="ti ti-circle-plus align-text-bottom"></i>{{ __('Create Ticket') }}</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover advance-datatable">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Headline') }}</th>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Assignment') }}</th>
                                <th>{{ __('Importance') }}</th>
                                <th>{{ __('Stage') }}</th>
                                <th>{{ __('Created Date') }}</th>
                                @if (Gate::check('edit ticket') || Gate::check('delete ticket') || Gate::check('reply ticket'))
                                    <th class="text-right">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supports as $support)
                                <tr role="row">
                                    <td>
                                        <a href="{{ route('ticket.show', \Crypt::encrypt($support->id)) }}">
                                            {{ ticketPrefix() . $support->support_id }}</a>
                                    </td>
                                    <td>
                                        {{ substr($support->headline, 0, 80) }}
                                    </td>

                                    <td>
                                        {{ !empty($support->clients) ? $support->clients->name : '-' }}
                                    </td>
                                    <td>
                                        {{ !empty($support->categories) ? $support->categories->category : '-' }}
                                    </td>
                                    <td>
                                        {{ !empty($support->assignments) ? $support->assignments->name : '-' }}
                                    </td>
                                    <td>
                                        @if ($support->importance == 'low')
                                            <span
                                                class="badge text-bg-primary">{{ \App\Models\Support::$importance[$support->importance] }}</span>
                                        @elseif($support->importance == 'medium')
                                            <span
                                                class="badge text-bg-info">{{ \App\Models\Support::$importance[$support->importance] }}</span>
                                        @elseif($support->importance == 'high')
                                            <span
                                                class="badge text-bg-warning">{{ \App\Models\Support::$importance[$support->importance] }}</span>
                                        @elseif($support->importance == 'critical')
                                            <span
                                                class="badge text-bg-danger">{{ \App\Models\Support::$importance[$support->importance] }}</span>
                                        @else
                                            <span
                                                class="badge text-bg-secondary">{{ \App\Models\Support::$importance[$support->importance] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($support->stage == 'pending')
                                            <span
                                                class="badge text-bg-primary">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @elseif($support->stage == 'open')
                                            <span
                                                class="badge text-bg-info">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @elseif($support->stage == 'close')
                                            <span
                                                class="badge text-bg-danger">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @elseif($support->stage == 'on_hold')
                                            <span
                                                class="badge text-bg-warning">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @elseif($support->stage == 'resolved')
                                            <span
                                                class="badge text-bg-success">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @elseif($support->stage == 'assigned')
                                            <span
                                                class="badge text-bg-dark">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @else
                                            <span
                                                class="badge text-bg-info">{{ \App\Models\Support::$stage[$support->stage] }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ dateFormat($support->created_at) }} <br> {{ timeFormat($support->created_at) }}
                                    </td>
                                    @if (Gate::check('edit ticket') || Gate::check('delete ticket') || Gate::check('reply ticket'))
                                        <td class="text-right">
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['ticket.destroy', $support->id]]) !!}
                                                @if (Gate::check('reply ticket'))
                                                    <a class="text-secondary" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Detail') }}"
                                                        href="{{ route('ticket.show', \Crypt::encrypt($support->id)) }}">
                                                        <i data-feather="eye"></i></a>
                                                @endif
                                                @if ($support->created_id == \Auth::user()->id || \Auth::user()->type == 'owner')
                                                    @if (Gate::check('edit ticket'))
                                                        <a class="text-success customModal" data-bs-toggle="tooltip"
                                                            data-size="lg" data-bs-original-title="{{ __('Edit') }}"
                                                            href="#"
                                                            data-url="{{ route('ticket.edit', $support->id) }}"
                                                            data-title="{{ __('Edit Ticket') }}"> <i
                                                                data-feather="edit"></i></a>
                                                    @endif
                                                    @if (Gate::check('delete ticket'))
                                                        <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Detete') }}" href="#"> <i
                                                                data-feather="trash-2"></i></a>
                                                    @endif
                                                @endif
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 @endsection
