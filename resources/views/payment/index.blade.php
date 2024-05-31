@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Payment</div>
                <button class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal">Create Payment
                </button>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    {{-- CREATE PAYMENT --}}

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>

                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Tenant') }}</label>
                            <select name="tenant_id" @class(['form-control', 'is-invalid' => $errors->has('tenant_id')])>
                                <option disabled selected>{{ __('Select') }}</option>
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id }}"> {{ $tenant->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tenant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Amount') }}</label>
                            <div class="input-group">
                                <input type="number" name="amount" @class(['form-control', 'is-invalid' => $errors->has('amount')]) placeholder="{{ __('Amount') }}"
                                value="{{ old('amount') }}" autofocus>
                            </div>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Invoice') }}</label>
                            <div class="input-group">
                                <textarea name="invoice" type="text" @class(['form-control', 'is-invalid' => $errors->has('invoice')]) placeholder="{{ __('Invoice') }}"
                                    value="{{ old('invoice') }}" autofocus></textarea>
                            </div>
                            @error('invoice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Date') }}</label>
                            <div class="input-group">
                                <input type="date" name="date" @class(['form-control', 'is-invalid' => $errors->has('date')])
                                    value="{{ old('date') }}">
                            </div>
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

    {{-- VIEW PAYMENT --}}

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
                        <label>{{ __('Date') }}</label>
                        <div class="input-group">
                            <input name="date" type="text" id="view_date" @class(['form-control'])
                                placeholder="{{ __('Date') }}" value="{{ old('date') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Invoice') }}</label>
                        <div class="input-group">
                            <input name="invoice" type="text" id="view_invoice" @class(['form-control'])
                                placeholder="{{ __('Invoice') }}" value="{{ old('invoice') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Amount') }}</label>
                        <div class="input-group">
                            <input name="amount" type="text" id="view_amount" @class(['form-control'])
                                placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT PAYMENT --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
        aria-hidden="true">
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
                        <div class="modal-body">
                            <div class="form-group">
                                <label>{{ __('Tenant') }}</label>
                                <select name="tenant_id" id="edit_tenant_id" @class(['form-control', 'is-invalid' => $errors->has('tenant_id')])>
                                    <option disabled selected>{{ __('Select') }}</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}"> {{ $tenant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label>{{ __('Amount') }}</label>
                                <div class="input-group">
                                    <textarea name="amount" id="edit_amount" type="text" @class(['form-control', 'is-invalid' => $errors->has('amount')])
                                        placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" autofocus></textarea>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label>{{ __('Invoice') }}</label>
                                <div class="input-group">
                                    <input name="invoice" id="edit_invoice" type="text" @class(['form-control', 'is-invalid' => $errors->has('invoice')])
                                        placeholder="{{ __('Invoice') }}" value="{{ old('invoice') }}" autofocus>
                                </div>
                                @error('invoice')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label>{{ __('Date') }}</label>
                                <div class="input-group">
                                    <input type="date" name="date" id="edit_date" @class(['form-control', 'is-invalid' => $errors->has('date')])
                                        value="{{ old('date') }}">
                                </div>
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

    {{-- DELETE PAYMENT --}}

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
        
    </script>
@endpush
