@extends('layouts.admin')

@section('title', __('Edit Product'))
@section('content-header',  __('Edit Product'))

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('shops.update', $item) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="{{ __('Name') }}" value="{{ old('name', $item->name) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    placeholder="{{ __('Description') }}">{{ old('description', $item->description) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="logo">{{ __('Logo') }}</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="logo" id="logo">
                    <label class="custom-file-label" for="logo">{{ __('Choose file') }}</label>
                </div>
                @error('logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">{{ __('Address') }}</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    id="address" placeholder="{{ __('Address') }}" value="{{ old('address', $item->address) }}">
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">{{ __('Phone') }}</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    placeholder="{{ __('Phone') }}" value="{{ old('phone', $item->phone) }}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    <option value="1" {{ old('status', $item->status) === 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('status', $item->status) === 0 ? 'selected' : ''}}>Inactive</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection
