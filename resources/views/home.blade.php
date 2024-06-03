@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Dashboard</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h5 class="mt-3 mx-4">Rent Overview</h5>
                        <span class="mx-4">Several works need to done.</span>
                        <div class="d-flex flex-column flex-md-row justify-content-around mt-2">
                            <div class="card mb-3 mb-md-0">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 12v.01" />
                                        <path d="M3 21h18" />
                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                    </svg>
                                    <span class="mx-3">Total Properties</span>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l14 0" />
                                            <path d="M15 16l4 -4" />
                                            <path d="M15 8l4 4" />
                                        </svg></a>
                                </div>
                                <div class="card-body text-end">
                                    {{ $houses }}
                                </div>
                            </div>
                            <div class="card mb-3 mb-md-0">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door-off"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 21h18" />
                                        <path d="M6 21v-15" />
                                        <path d="M7.18 3.175c.25 -.112 .528 -.175 .82 -.175h8a2 2 0 0 1 2 2v9" />
                                        <path d="M18 18v3" />
                                        <path d="M3 3l18 18" />
                                    </svg>
                                    <span class="mx-3">Properties Rented</span>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l14 0" />
                                            <path d="M15 16l4 -4" />
                                            <path d="M15 8l4 4" />
                                        </svg></a>
                                </div>
                                <div class="card-body text-end">
                                    {{ $houseRented }}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    <span class="mx-3">Total Tenant</span>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l14 0" />
                                            <path d="M15 16l4 -4" />
                                            <path d="M15 8l4 4" />
                                        </svg></a>
                                </div>
                                <div class="card-body text-end">
                                    {{ $tenants }}
                                </div>
                            </div>
                            <div class="card mb-md-0 mb-3">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path
                                            d="M3 6m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M18 12l.01 0" />
                                        <path d="M6 12l.01 0" />
                                    </svg>
                                    <span class="mx-3">Payment This Month</span>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l14 0" />
                                            <path d="M15 16l4 -4" />
                                            <path d="M15 8l4 4" />
                                        </svg></a>
                                </div>
                                <div class="card-body text-end">
                                    {{ $totalPaymentsThisMonth }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
