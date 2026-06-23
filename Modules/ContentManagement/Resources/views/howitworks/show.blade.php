@extends('layouts.admin')
@section('page_title', $howitwork->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush
@section('content')

@php
    $selectedGroupIds = $howitwork->groups->pluck('id')->map(function ($id) {
        return (int) $id;
    })->all();
    if (!empty($howitwork->how_it_work_group_id) && !in_array((int) $howitwork->how_it_work_group_id, $selectedGroupIds, true)) {
        $selectedGroupIds[] = (int) $howitwork->how_it_work_group_id;
    }
    $groupNames = $howitwork->groups->pluck('name')->filter()->values();
    $attachedGroupCount = count($selectedGroupIds);
    $mediaPath = (string) $howitwork->display_image;
    $mediaExt = strtolower(pathinfo($mediaPath, PATHINFO_EXTENSION));
    $isVideo = in_array($mediaExt, ['mp4', 'webm', 'mov'], true);
    $mediaUrl = !empty($mediaPath) ? asset($mediaPath) : asset('img/icons/upload-img.jpg');
@endphp

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('howitworks/manage') }}"> How It Works</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $howitwork->label }}</li>
        <div class="ml-auto mr-0">
            <a class="btn btn-primary btn-sm mr-2" href="{{ route('howitworks.edit',$howitwork->id) }}"><i class="fa fa-edit"></i> Edit Item</a>
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('howitworks.manage') }}">Back</a>
        </div>
    </ol>
</nav>

<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-2">{{ $howitwork->label }}</h3>
                <div class="mb-3">
                    @if($groupNames->isNotEmpty())
                        @foreach($groupNames as $groupName)
                            <span class="badge badge-dark">{{ $groupName }}</span>
                        @endforeach
                    @elseif(!empty($howitwork->forwhom))
                        <span class="badge badge-dark">{{ $howitwork->forwhom }}</span>
                    @endif
                    @if($howitwork->published)
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-danger">Hidden</span>
                    @endif
                </div>

                <div class="mb-3">
                    {!! $howitwork->overview !!}
                </div>

                @if (!empty($howitwork->button_text) && !empty($howitwork->button_url))
                    <div class="mb-3">
                        <strong>CTA:</strong>
                        <a href="{{ url($howitwork->button_url) }}" class="btn btn-sm btn-success">{{ $howitwork->button_text }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">Display Media</h5>
                @if($isVideo && !empty($mediaPath))
                    <video class="w-100 rounded mb-3" controls loop muted playsinline>
                        <source src="{{ $mediaUrl }}" type="{{ $mediaExt === 'mov' ? 'video/quicktime' : 'video/'.$mediaExt }}">
                        Your browser does not support video playback.
                    </video>
                @else
                    <img src="{{ $mediaUrl }}" alt="{{ $howitwork->label }}" class="img-fluid mb-3 rounded">
                @endif

                <form action="{{ route('howitworks.changeimage') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="howitwork_id" value="{{ $howitwork->id }}">
                    <div class="form-group">
                        <input type="file" name="display_image" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}" accept=".jpg,.jpeg,.png,.gif,.mp4,.webm,.mov" required>
                        <small class="text-muted">Supports image, animated gif, mp4, webm, mov.</small>
                        @if ($errors->has('display_image'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('display_image') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-block">Change Media</button>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">Group Attachments</h5>
                <form action="{{ route('howitworks.syncgroups', $howitwork->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <select name="how_it_work_group_ids[]" class="custom-select" multiple size="6">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ in_array((int) $group->id, $selectedGroupIds, true) ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Attach this item to one or multiple workflow groups. Clear all selections to detach from every group.</small>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success btn-block">Save Group Attachments</button>
                </form>
            </div>
        </div>

        <div class="card border-danger">
            <div class="card-body">
                <h5 class="text-danger mb-2">Delete Item</h5>
                @if($attachedGroupCount > 0)
                    <div class="alert alert-warning mb-0">Detach this item from all groups before deleting it.</div>
                @else
                    <form action="{{ route('howitworks.destroy', $howitwork->id) }}" method="POST" onsubmit="return confirm('Delete this How It Works item permanently?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-block">Delete How It Works</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
