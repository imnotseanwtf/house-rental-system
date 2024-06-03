@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Tenant</div>
                <button class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal">Create Tenant
                </button>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    {{-- CREATE TENANT --}}

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>

                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('tenant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <div class="input-group">
                                <input name="name" type="text" @class(['form-control', 'is-invalid' => $errors->has('name')])
                                    placeholder="{{ __('Name') }}" value="{{ old('name') }}" autofocus>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('House No.') }}</label>
                            <select name="house_id" @class(['form-control', 'is-invalid' => $errors->has('house_id')])>
                                <option selected disabled>Select</option>
                                @foreach ($houses as $house)
                                    <option value="{{ $house->id }}">{{ $house->house_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Start Date') }}</label>
                            <input name="start_date" type="date" @class(['form-control', 'is-invalid' => $errors->has('start_date')]) value="{{ old('start_date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- VIEW TENANT --}}

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="input-group">
                            <input name="name" type="text" id="view_name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" readonly>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label>{{ __('House Number') }}</label>
                        <div class="input-group">
                            <input name="house_number" type="text" id="view_house_number" class="form-control" placeholder="{{ __('House Number') }}" value="{{ old('house_number') }}" readonly>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label>{{ __('Monthly Rate') }}</label>
                        <div class="input-group">
                            <input name="price" type="text" id="view_price" class="form-control" placeholder="{{ __('Monthly Rate') }}" value="{{ old('price') }}" readonly>
                        </div>
                     </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT TENANT --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>

                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" id="update-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <div class="input-group">
                                <input name="name" type="text" id="edit_name" @class(['form-control', 'is-invalid' => $errors->has('name')])
                                    placeholder="{{ __('Name') }}" value="{{ old('name') }}" autofocus>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('House No.') }}</label>
                            <select name="house_id" id="edit_house" @class(['form-control', 'is-invalid' => $errors->has('house_id')])>
                                <option selected disabled>Select</option>
                                @foreach ($houses as $house)
                                    <option value="{{ $house->id }}">{{ $house->house_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Start Date') }}</label>
                            <input name="start_date" id="edit_house" type="date" @class(['form-control', 'is-invalid' => $errors->has('start_date')]) value="{{ old('start_date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DELETE TENANT --}}

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deletePromoModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-2">Are you sure you want to delete this?</div>
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
        $(() => {
            const tableInstance = window.LaravelDataTables['tenant_dataTable'] = $('#tenant_dataTable')
                .DataTable()
            tableInstance.on('draw.dt', function() {
                $('.viewBtn').click(function() {
                    fetch('/tenant/' + $(this).data('tenant'))
                        .then(response => response.json())
                        .then(tenant => {
                            $('#view_category').val(house_type.category);
                        });
                })

                $('.editBtn').click(function() {
                    fetch('/tenant/' + $(this).data('tenant'))
                        .then(response => response.json())
                        .then(tenant => {
                            $('#edit_category').val(house_type.category);
                            $('#update-form').attr('action', '/tenant/' + $(this).data(
                                'tenant'));
                        });
                })

                $('.deleteBtn').click(function() {
                    $('#delete-form').attr('action', '/tenant/' + $(this).data('tenant'));
                });

            })
        });
    </script>
@endpush

