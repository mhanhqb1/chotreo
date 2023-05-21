@extends('layouts.admin')

@section('title', __('Shop List'))
@section('content-header', __('Shop List'))
@section('content-actions')
<a href="{{route('shops.create')}}" class="btn btn-primary">{{ __('Create') }}</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Logo') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Updated At') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td><img class="product-img" src="{{ Storage::url($item->logo) }}" alt=""></td>
                    <td>
                        <span
                            class="right badge badge-{{ $item->status ? 'success' : 'danger' }}">{{$item->status ? __('Active') : __('Inactive') }}</span>
                    </td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a href="{{ route('shops.edit', $item) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('shops.destroy', $item)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->render() }}
    </div>
</div>
@endsection

@section('js')
@include('layouts.partials.footer.sweetalert2')
@endsection
