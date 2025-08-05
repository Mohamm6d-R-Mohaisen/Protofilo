@extends('admin.layouts.master')
@section('title', isset($category) ? __('admin.global.edit_about') : __('admin.global.add_new_about'))
@section('content')

<form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm"
    data-kt-redirect="{{ route('admin.categories.index') }}"
    action="{{ isset($about) ? route('admin.categories.update', $about->id) : route('admin.categories.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @isset($about)
        @method('PATCH')
    @endisset


    <!-- Main Form -->
    <div class="d-flex flex-column flex-row-fluid gap-3 col-lg-9">
        <div class="card card-flush generalDataTap">
            <div class="salesTitle">
                <h3>About Details</h3>
            </div>
            <div class="card-body pt-0">
                <div class="mb-5">
                    <label class="required form-label">Name</label>
                    <input type="text" name="name" class="form-control" required
                        value="{{ old('name', $about->name ?? '') }}">
                </div>







    <div class="page-buttuns mt-5">
                <div class="row justify-content-between">
                    <div class="d-flex justify-content-end right">
                        <button type="submit" id="kt_submit" class="btn btn-primary me-5">
                            <span class="indicator-label">Save</span>

                        </button>
                        <a href="{{ route('admin.admins.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5 cancel">Cancel</a>
                    </div>
                </div>
            </div>
</form>


@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/handleSubmitForm.js') }}"></script>
<script src="{{ asset('admin/plugins/image-input.js') }}"></script>

@endpush
