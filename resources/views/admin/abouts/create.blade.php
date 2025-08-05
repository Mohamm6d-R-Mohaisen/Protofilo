@extends('admin.layouts.master')
@section('title', isset($about) ? __('admin.global.edit_about') : __('admin.global.add_new_about'))
@section('content')

<form id="kt_form" class="form row d-flex flex-column flex-lg-row addForm"
    data-kt-redirect="{{ route('admin.abouts.index') }}"
    action="{{ isset($about) ? route('admin.abouts.update', $about->id) : route('admin.abouts.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @isset($about)
        @method('PATCH')
    @endisset

    <!-- Sidebar: Image Upload -->
    <div class="d-flex flex-column gap-5 col-lg-3 mb-7">
        <div class="card card-flush">
            <div class="card-header justify-content-center">
                <h3 class="card-title">Image</h3>
            </div>
            <div class="card-header card-header justify-content-center p-5">
                <div class="card-toolbar">
                    <div class="image-input image-input-outline" data-kt-image-input="true">
                        <div class="image-input-wrapper w-200px h-200px"
                            style="background-image: url({{ isset($about) && $about->image ? asset($about->image) : asset('admin_assets/media/svg/files/blank-image.svg') }})">
                        </div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Image">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Image">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <input type="hidden" name="remove_image" value="0" data-kt-image-input="remove" />

                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <div class="mb-5">
                    <label class="required form-label">Position</label>
                    <input type="text" name="position" class="form-control" required
                        value="{{ old('position', $about->position ?? '') }}">
                </div>
                <div class="mb-5">
                    <label class="required form-label">Title</label>
                    <input type="text" name="title" class="form-control" required
                        value="{{ old('title', $about->title ?? '') }}">
                </div>
                <div class="mb-5">
                    <label class="required form-label">Description</label>
                    <textarea name="description" rows="9" class="form-control"
                        required>{{ old('description', $about->description ?? '') }}</textarea>
                </div>

                <!-- Button to open modal -->
                <div class="mb-3">
                    <label class="form-label d-block">Details</label>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal">
                        Add Detail
                    </button>
                </div>

                <!-- Details List -->
                <div id="detailsContainer" class="d-flex flex-column gap-3 mb-4">
                    @if(old('details'))
                        @foreach(old('details') as $key => $detail)
                            <div class="card p-3 position-relative" data-id="{{ $key }}">
                                <input type="hidden" name="details[{{ $key }}][name]" value="{{ $detail['name'] }}">
                                <input type="hidden" name="details[{{ $key }}][description]" value="{{ $detail['description'] }}">
                                <strong>Name:</strong> {{ $detail['name'] }}<br>
                                <strong>Description:</strong> {{ $detail['description'] }}
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 remove-detail"></button>
                            </div>
                        @endforeach
                    @elseif(isset($about) && is_array($about->details))
                        @foreach($about->details as $key => $detail)
                            <div class="card p-3 position-relative" data-id="{{ $key }}">
                                <input type="hidden" name="details[{{ $key }}][name]" value="{{ $detail['name'] }}">
                                <input type="hidden" name="details[{{ $key }}][description]" value="{{ $detail['description'] }}">
                                <strong>Name:</strong> {{ $detail['name'] }}<br>
                                <strong>Description:</strong> {{ $detail['description'] }}
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 remove-detail"></button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
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

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Add Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="detailName">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="detailDesc" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveDetail">Add</button>
                <button type="button" class="btn btn-success d-none" id="updateDetail">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/handleSubmitForm.js') }}"></script>
<script src="{{ asset('admin/plugins/image-input.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const detailsContainer = document.getElementById('detailsContainer');
        let detailIndex = document.querySelectorAll('#detailsContainer .card').length;

        const modalEl = document.getElementById('detailModal');
        const modalTitle = document.getElementById('detailModalLabel');
        const detailNameInput = document.getElementById('detailName');
        const detailDescInput = document.getElementById('detailDesc');
        const saveBtn = document.getElementById('saveDetail');
        const updateBtn = document.getElementById('updateDetail');

        let currentEditId = null; // لتحديد إذا كنا نعدل

        // --- فتح المودال للإضافة ---
        document.querySelector('[data-bs-target="#detailModal"]').addEventListener('click', function () {
            modalTitle.textContent = 'Add Detail';
            detailNameInput.value = '';
            detailDescInput.value = '';
            saveBtn.classList.remove('d-none');
            updateBtn.classList.add('d-none');
            currentEditId = null;
        });

        // --- حفظ تفصيل جديد ---
        saveBtn.addEventListener('click', function () {
            const name = detailNameInput.value.trim();
            const description = detailDescInput.value.trim();

            if (!name || !description) {
                alert('Please fill out both name and description.');
                return;
            }

            const detailHtml = `
                <div class="card p-3 position-relative" data-id="${detailIndex}">
                    <input type="hidden" name="details[${detailIndex}][name]" value="${name}">
                    <input type="hidden" name="details[${detailIndex}][description]" value="${description}">
                    <strong>Name:</strong> ${name}<br>
                    <strong>Description:</strong> ${description}
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 remove-detail"></button>
                </div>
            `;
            detailsContainer.insertAdjacentHTML('beforeend', detailHtml);
            detailIndex++;

            // إغلاق المودال
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.hide();
        });

        // --- التعامل مع الحذف وفتح التعديل ---
        detailsContainer.addEventListener('click', function (e) {
            // حالة الضغط على زر الحذف
            if (e.target.classList.contains('remove-detail')) {
                e.stopPropagation(); // منع انتشار الحدث لفتح المودال
                const card = e.target.closest('.card');

                // تأكيد الحذف عبر SweetAlert2
                Swal.fire({
                    title: 'Are you sure you want to delete?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        card.remove();
                        Swal.fire(
                            'Deleted!',
                            'Detail has been deleted successfully.',
                            'success'
                        )
                    }
                });
                return; // منع تنفيذ باقي الكود
            }

            // حالة الضغط على البطاقة (غير زر الحذف) لفتح المودال
            if (e.target.closest('.card')) {
                const card = e.target.closest('.card');
                const name = card.querySelector('input[name*="[name]"]').value;
                const description = card.querySelector('input[name*="[description]"]').value;
                const id = card.dataset.id;

                // تعبئة الحقول
                detailNameInput.value = name;
                detailDescInput.value = description;
                modalTitle.textContent = 'Edit Detail';

                // تغيير وضع الأزرار
                saveBtn.classList.add('d-none');
                updateBtn.classList.remove('d-none');

                // تعيين الوضع للتعديل
                currentEditId = id;

                // فتح المودال
                new bootstrap.Modal(modalEl).show();
            }
        });

        // --- تحديث التفصيل ---
        updateBtn.addEventListener('click', function () {
            const name = detailNameInput.value.trim();
            const description = detailDescInput.value.trim();

            if (!name || !description) {
                alert('Please fill out both name and description.');
                return;
            }

            const card = detailsContainer.querySelector(`.card[data-id="${currentEditId}"]`);
            if (card) {
                card.innerHTML = `
                    <input type="hidden" name="details[${currentEditId}][name]" value="${name}">
                    <input type="hidden" name="details[${currentEditId}][description]" value="${description}">
                    <strong>Name:</strong> ${name}<br>
                    <strong>Description:</strong> ${description}
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 remove-detail"></button>
                `;
            }

            // إغلاق المودال
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        });

        // --- تنظيف المودال عند الإغلاق ---
        modalEl.addEventListener('hidden.bs.modal', function () {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';

            // إعادة تعيين الحقول
            detailNameInput.value = '';
            detailDescInput.value = '';
            saveBtn.classList.remove('d-none');
            updateBtn.classList.add('d-none');
            currentEditId = null;
        });
    });
</script>
@endpush
