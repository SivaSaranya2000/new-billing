
@extends('layout.nav')

@section('content')

<div class="container mt-4">

    <div class="card shadow border-0">

        <div class="card-body">

            <!-- Header -->
            <div class="row mb-4">

                <div class="col-md-6">
                    <h2 class="fw-bold text-primary">INVOICE</h2>

                    <h5 class="mt-3">Billing Application</h5>

                    <p class="mb-0">
                        Chennai, Tamil Nadu
                    </p>

                    <p>
                        Phone: +91 9876543210
                    </p>
                </div> 

                <div class="col-md-6 text-end">

                    <h5>
                        Invoice No :
                        <span class="text-dark">
                            {{ $sell->sales_code }}
                        </span>
                    </h5>

                    <h6>
                        Date :
                        {{ date('d-m-Y', strtotime($sell->sales_date)) }}
                    </h6>

                    <h6>
                        Reference :
                        {{ $sell->reference_no }}
                    </h6>
                </div>

            </div>

            <!-- Customer -->
            <div class="row mb-4">

                <div class="col-md-6">

                    <div class="border rounded p-3 bg-light">

                        <h5 class="fw-bold">
                            Customer Details
                        </h5>

                        <p class="mb-1">
                            Name :
                            {{ $sell->customer->name ?? 'Walk-in Customer' }}
                        </p>

                        <p class="mb-1">
                            Phone :
                            {{ $sell->customer->phone ?? '-' }}
                        </p>

                        <p class="mb-0">
                            Address :
                            {{ $sell->customer->address ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- Items -->
            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax %</th>
                            <th>Tax Amt</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                        @php
                            $i = 1;
                        @endphp

                        @foreach($sell->items as $item)

                        <tr>

                            <td>{{ $i++ }}</td>

                            <td>
                                {{ $item->product->name ?? '' }}
                            </td>

                            <td>{{ $item->qty }}</td>

                            <td>
                                ₹{{ number_format($item->price, 2) }}
                            </td>

                            <td>
                                ₹{{ number_format($item->discount, 2) }}
                            </td>

                            <td>
                                {{ $item->tax }}%
                            </td>

                            <td>
                                ₹{{ number_format($item->tax_amount, 2) }}
                            </td>

                            <td class="fw-bold">
                                ₹{{ number_format($item->total, 2) }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Summary -->
            <div class="row mt-4">

                <div class="col-md-6"></div>

                <div class="col-md-6">

                    <table class="table table-bordered">

                        <tr>
                            <th>Subtotal</th>
                            <td class="text-end">
                                ₹{{ number_format($sell->subtotal, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Other Charges</th>
                            <td class="text-end">
                                ₹{{ number_format($sell->other_charges, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Discount</th>
                            <td class="text-end">
                                ₹{{ number_format($sell->discount, 2) }}
                            </td>
                        </tr>

                        <tr class="table-success">

                            <th class="fs-5">
                                Grand Total
                            </th>

                            <th class="text-end fs-5">
                                ₹{{ number_format($sell->grand_total, 2) }}
                            </th>

                        </tr>

                    </table>

                </div>

            </div>

            <!-- Buttons -->
            <div class="text-center mt-4">

                <button onclick="window.print()"
                    class="btn btn-primary">
                    Print Invoice
                </button>

                <a href="{{ url()->previous() }}"
                    class="btn btn-secondary">
                    Back
                </a>

            </div>

        </div>

    </div>

</div>

@endsection