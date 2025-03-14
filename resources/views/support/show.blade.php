@extends('layouts.app')
@section('page-title')
    {{ __('Ticket') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('ticket.index') }}">{{ __('Ticket') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ ticketPrefix() . $support->support_id }}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            @if (Gate::check('edit ticket') || $support->assignment == 0)
                <div class="d-print-none card mb-3">
                    <div class="card-body p-3">
                        <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                            <li class="list-inline-item align-bottom me-2">
                                @if ($support->assignment == 0)
                                    <a href="#" class="avtar avtar-s btn-link-secondary customModal"
                                        data-bs-toggle="tooltip" data-bs-original-title="{{ __('Assign') }}" data-size="lg"
                                        data-url="{{ route('ticket.edit', $support->id) }}"
                                        data-title="{{ __('Assign') }}">
                                        <i class="f-22" data-feather="user-plus"></i>
                                    </a>
                                @endif

                            </li>
                            <li class="list-inline-item align-bottom me-2">
                                @if (Gate::check('edit ticket'))
                                    <a href="#" class="avtar avtar-s btn-link-secondary customModal"
                                        data-bs-toggle="tooltip" data-bs-original-title="{{ __('Edit') }}" data-size="lg"
                                        data-url="{{ route('ticket.edit', $support->id) }}"
                                        data-title="{{ __('Edit Ticket') }}">
                                        <i class="f-22" data-feather="edit"></i>
                                    </a>
                                @endif

                            </li>



                        </ul>
                    </div>
                </div>
            @endif


            <div class="card">


                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                            <div class="row">

                                <div class="col-lg-4 col-xxl-3">
                                    <div>
                                        <div class="card border">
                                            <div class="card-header">

                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img class="img-radius img-fluid wid-40"
                                                            src="{{ asset(Storage::url('upload/profile/' . $support->clients->profile)) }}"
                                                            alt="{{ $support->clients->name }}" />
                                                    </div>
                                                    <div class="flex-grow-1 mx-3">
                                                        <h5 class="mb-1">{{ $support->clients->name }}</h5>
                                                        <h6 class="text-muted mb-0">{{ $support->clients->email }}</h6>
                                                        <h6 class="text-muted mb-0">
                                                            {{ $support->clients->phone_number }}
                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-body px-2 pb-0">
                                                <div class="list-group list-group-flush">
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-icons-two-tone f-20">drag_indicator</i>
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <h5 class="m-0">{{ __('Category') }}</h5>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <small>{{ !empty($support->categories) ? $support->categories->category : '-' }}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-icons-two-tone f-20">calendar_today</i>
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <h5 class="m-0">{{ __('Created Date') }}</h5>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <small>{{ dateFormat($support->created_at) }}
                                                                    - {{ timeFormat($support->created_at) }}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-icons-two-tone f-20">accessibility</i>
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <h5 class="m-0">{{ __('Importance') }}</h5>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <small>
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
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="material-icons-two-tone f-20">storage</i>
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <h5 class="m-0">{{ __('Stage') }}</h5>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <small>
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
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i
                                                                    class="material-icons-two-tone f-20">stacked_line_chart</i>
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <h5 class="m-0">{{ __('Assigment Status') }}</h5>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <span
                                                                    class="badge text-bg-danger">{{ __('Pending') }}</span>

                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div>
                                        @if (!empty($support->assignment))
                                            <div class="card follower-card">
                                                <div class="card-body p-3 text-center">
                                                    <div class="d-flex align-items-start mb-3">
                                                        <div class="flex-grow-1 mx-2">
                                                            <img class="img-radius img-fluid wid-70"
                                                                src="{{ asset(Storage::url('upload/profile/' . $support->assignments->profile)) }}"
                                                                alt="{{ $support->assignments->name }}" />
                                                        </div>

                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                        <h4 class="fw-semibold mb-0 text-truncate">
                                                            {{ $support->assignments->name }}</h4>

                                                    </div>
                                                    <div class="g-1">
                                                        <div class="col-12">
                                                            <h6>{{ $support->assignments->email }}</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <h6>{{ $support->assignments->phone_number }}</h6>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-lg-8 col-xxl-9">


                                    <div class="card border">
                                        <div class="card-header">
                                            <h5>{{ __('Comments') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="bg-light rounded p-2 mb-3">

                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0">
                                                        <img class="img-radius img-fluid wid-40"
                                                            src="{{ !empty($support->createdUser) && !empty($support->createdUser->profile) ? asset(Storage::url('upload/profile')) . '/' . $support->createdUser->profile : asset(Storage::url('upload/profile')) . '/avatar.png' }}"
                                                            alt="image" />
                                                    </div>
                                                    <div class="flex-grow-1 mx-3">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0 me-3">
                                                                {{ !empty($support->createdUser) ? $support->createdUser->name : '' }}
                                                            </h5>
                                                            <span
                                                                class="text-body text-opacity-50 d-flex align-items-center">
                                                                <i class="fas fa-circle f-8 me-2"></i>
                                                                {{ dateFormat($support->created_at) }}
                                                                {{ timeFormat($support->created_at) }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <p class="text-header">
                                                    {{ $support->summary }}
                                                </p>
                                                <div class="row">
                                                    @foreach ($support->files as $file)
                                                        <a class="img-radius d-none d-sm-inline-flex me-3 img-fluid wid-35"
                                                            href="{{ asset('/storage/upload/support/' . $file->files) }}"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Download') }}"
                                                            target="_blank">

                                                            <i class="ph-duotone ph-download-simple f-20"></i>
                                                        </a>
                                                    @endforeach

                                                </div>
                                            </div>


                                            @foreach ($support->reply as $supportReply)
                                                @if ($supportReply->user_id != \Auth::user()->id)
                                                    <div class="bg-light rounded p-2 mb-3">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-shrink-0">
                                                                <img class="img-radius img-fluid wid-40"
                                                                    src="{{ !empty($supportReply->user) && !empty($supportReply->user->profile) ? asset(Storage::url('upload/profile')) . '/' . $supportReply->user->profile : asset(Storage::url('upload/profile')) . '/avatar.png' }}"
                                                                    alt="" />
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <div class="d-flex align-items-center">
                                                                    <h5 class="mb-0 me-3">
                                                                        {{ !empty($supportReply->user) ? $supportReply->user->name : '' }}
                                                                    </h5>
                                                                    <span
                                                                        class="text-body text-opacity-50 d-flex align-items-center">
                                                                        <i class="fas fa-circle f-8 me-2"></i>
                                                                        {{ dateFormat($supportReply->created_at) }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <p class="text-header">
                                                            {{ $supportReply->description }}
                                                        </p>
                                                        <div class="row">
                                                            @foreach ($support->files as $file)
                                                                <a class="img-radius d-none d-sm-inline-flex me-3 img-fluid wid-35"
                                                                    href=" {{ asset('/storage/upload/support/' . $file->files) }}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{ __('Download') }}"
                                                                    target="_blank">

                                                                    <i class="ph-duotone ph-download-simple f-20"></i>
                                                                </a>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="bg-light rounded p-2 mb-3">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-shrink-0">
                                                                <img class="img-radius img-fluid wid-40"
                                                                    src="{{ !empty($supportReply->user) && !empty($supportReply->user->profile) ? asset(Storage::url('upload/profile')) . '/' . $supportReply->user->profile : asset(Storage::url('upload/profile')) . '/avatar.png' }}"
                                                                    alt="" />
                                                            </div>
                                                            <div class="flex-grow-1 mx-3">
                                                                <div class="d-flex align-items-center">
                                                                    <h5 class="mb-0 me-3">
                                                                        {{ !empty($supportReply->user) ? $supportReply->user->name : '' }}
                                                                    </h5>
                                                                    <span
                                                                        class="text-body text-opacity-50 d-flex align-items-center">
                                                                        <i class="fas fa-circle f-8 me-2"></i>
                                                                        {{ dateFormat($supportReply->created_at) }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <p class="text-header">
                                                            {{ $supportReply->description }}
                                                        </p>
                                                        <div class="row">
                                                            @foreach ($support->files as $file)
                                                                <a class="img-radius d-none d-sm-inline-flex me-3 img-fluid wid-35"
                                                                    href="{{ asset('/storage/upload/support/' . $file->files) }}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{ __('Download') }}"
                                                                    target="_blank">

                                                                    <i class="ph-duotone ph-download-simple f-20"></i>
                                                                </a>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach



                                        </div>
                                    </div>


                                    @if ($support->stage != 'close' || $support->stage != 'pending')
                                        <div class="card border">
                                            <div class="card-header">
                                                <h5>{{ __('Add Comment') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                {{ Form::open(['route' => ['ticket.reply', $support->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="flex-shrink-0">
                                                        <img class="img-radius d-none d-sm-inline-flex me-3 img-fluid wid-35"
                                                            src="{{ asset(Storage::url('upload/profile/' . $support->clients->profile)) }}"
                                                            alt="{{ $support->clients->name }}" />
                                                    </div>
                                                    <div class="flex-grow-1 me-3">


                                                        <textarea class="form-control" rows="1" name="comment" placeholder="{{ __('Write a comment...') }}"></textarea>

                                                    </div>
                                                    <div class="flex-grow-1 me-3">

                                                        {{ Form::file('attachment[]', ['class' => 'form-control', 'multiple']) }}

                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <button type="submit"
                                                            class="btn btn-secondary">{{ __('Send') }}</button>
                                                    </div>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>






                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>




@endsection
