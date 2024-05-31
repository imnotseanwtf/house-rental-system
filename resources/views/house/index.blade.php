@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        {{ $error }}<br />
    @endforeach
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>House</div>
                <button class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal">Create House
                </button>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    {{-- CREATE HOUSE --}}

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>

                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('House No.') }}</label>
                            <div class="input-group">
                                <input name="house_number" type="number" @class(['form-control', 'is-invalid' => $errors->has('house_number')])
                                    placeholder="{{ __('House No.') }}" value="{{ old('house_number') }}" autofocus>
                            </div>
                            @error('house_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Select House Type') }}</label>
                            <select name="house_type_id" @class(['form-control', 'is-invalid' => $errors->has('house_number')])>
                                <option disabled selected>{{ __('Select') }}</option>
                                @foreach ($houseTypeCategories as $houseTypeCategory)
                                    <option value="{{ $houseTypeCategory->id }}"> {{ $houseTypeCategory->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Description') }}</label>
                            <div class="input-group">
                                <textarea name="description" @class(['form-control', 'is-invalid' => $errors->has('description')])></textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Price') }}</label>
                            <div class="input-group">
                                <input name="price" type="number" @class(['form-control', 'is-invalid' => $errors->has('price')])
                                    placeholder="{{ __('Price') }}" value="{{ old('price') }}" autofocus>
                            </div>
                            @error('price')
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

    {{-- VIEW HOUSE --}}

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
                        <label>{{ __('House No.') }}</label>
                        <div class="input-group">
                            <input type="text" id="view_house_number" @class(['form-control'])
                                placeholder="{{ __('House No.') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>{{ __('Category') }}</label>
                        <div class="input-group">
                            <input type="text" id="view_category" @class(['form-control'])
                                placeholder="{{ __('Category') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>{{ __('Description') }}</label>
                        <div class="input-group">
                            <input type="text" id="view_description" @class(['form-control'])
                                placeholder="{{ __('Description') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>{{ __('Price') }}</label>
                        <div class="input-group">
                            <input type="text" id="view_price" @class(['form-control'])
                                placeholder="{{ __('Price') }}" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT HOUSE --}}

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
                            <label>{{ __('House No.') }}</label>
                            <div class="input-group">
                                <input name="house_number" type="number" @class(['form-control', 'is-invalid' => $errors->has('house_number')])
                                    placeholder="{{ __('House No.') }}" value="{{ old('house_number') }}" autofocus id="edit_house_number">
                            </div>
                            @error('house_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Select House Type Category') }}</label>
                            <select name="house_type_id" @class(['form-control', 'is-invalid' => $errors->has('house_type_id')])>
                                <option disabled selected>{{ __('Select') }}</option>
                                @foreach ($houseTypeCategories as $houseTypeCategory)
                                    <option value="{{ $houseTypeCategory->id }}"> {{ $houseTypeCategory->category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('house_type_id')
                                <div class="invalid-feedback">{{ __('The house type category field is required.') }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Description') }}</label>
                            <div class="input-group">
                                <textarea name="description" @class(['form-control', 'is-invalid' => $errors->has('description')]) id="edit_description">
                                </textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Price') }}</label>
                            <div class="input-group">
                                <input name="price" type="number" @class(['form-control', 'is-invalid' => $errors->has('price')])
                                    placeholder="{{ __('Price') }}" value="{{ old('price') }}" autofocus id="edit_price">
                            </div>
                            @error('price')
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

    {{-- DELETE HOUSE --}}

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
            const tableInstance = window.LaravelDataTables['house_dataTable'] = $('#house_dataTable')
                .DataTable()
            tableInstance.on('draw.dt', function() {
                $('.viewBtn').click(function() {
                    fetch('/house/' + $(this).data('house'))
                        .then(response => response.json())
                        .then(responseData => {
                            const house = responseData.data;
                            $('#view_house_number').val(house.house_number);
                            $('#view_category').val(house.houseType.category);

                            $('#view_description').val(house.description);
                            $('#view_price').val(house.price);
                        })
                });

                $('.editBtn').click(function() {
                    fetch('/house/' + $(this).data('house'))
                        .then(response => response.json())
                        .then(responseData => {
                            const house = responseData.data;
                            $('#edit_house_number').val(house.house_number);
                            $('#edit_category').val(house.houseType.category);
                            $('#edit_description').val(house.description);
                            $('#edit_price').val(house.price);
                            $('#update-form').attr('action', '/house/' + $(this).data(
                                'house'));
                        });
                })

                $('.deleteBtn').click(function() {
                    $('#delete-form').attr('action', '/house/' + $(this).data('house'));
                });

            })
        });
    </script>
@endpush
