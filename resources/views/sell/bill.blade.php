<!DOCTYPE html>
<html>
<head>

    <title>Invoice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .invoice-box{
            background:#fff;
            padding:30px;
            max-width:900px;
            margin:auto;
            margin-top:30px;
            border:1px solid #ddd;
        }

        @media print {

            .no-print{
                display:none !important;
            }

            body{
                background:#fff;
            }

            .invoice-box{
                border:none;
                margin:0;
                width:100%;
            }
        }

    </style>

</head>

<body>

<div class="container">

    <div class="invoice-box">

        <!-- Header -->
        <div class="row mb-4">

            <div class="col-6">

                <h2 class="fw-bold text-primary">
                    INVOICE
                </h2>

                <h5>Billing Application</h5>

                <p class="mb-0">
                    Chennai, Tamil Nadu
                </p>

                <p>
                    Phone: +91 9876543210
                </p>

            </div>

            <div class="col-6 text-end">

                <h5>
                    Invoice No :
                    {{ $sell->sales_code }}
                </h5>

                <p>
                    Date :
                    {{ date('d-m-Y', strtotime($sell->sales_date)) }}
                </p>

                <p>
                    Reference :
                    {{ $sell->reference_no }}
                </p>

            </div>

        </div>

        <!-- Customer -->
        <div class="card mb-4">

            <div class="card-body">

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

        <!-- Table -->
        <table class="table table-bordered">

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

                @foreach($sell->items as $key => $item)

                <tr>

                    <td>{{ $key + 1 }}</td>

                    <td>
                        {{ $item->product->name ?? '' }}
                    </td>

                    <td>{{ $item->qty }}</td>

                    <td>
                        ₹{{ number_format($item->price,2) }}
                    </td>

                    <td>
                        ₹{{ number_format($item->discount,2) }}
                    </td>

                    <td>
                        {{ $item->tax }}%
                    </td>

                    <td>
                        ₹{{ number_format($item->tax_amount,2) }}
                    </td>

                    <td>
                        ₹{{ number_format($item->total,2) }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <!-- Totals -->
        <div class="row justify-content-end">

            <div class="col-md-5">

                <table class="table table-bordered">

                    <tr>
                        <th>Subtotal</th>
                        <td class="text-end">
                            ₹{{ number_format($sell->subtotal,2) }}
                        </td>
                    </tr>

                    <tr>
                        <th>Other Charges</th>
                        <td class="text-end">
                            ₹{{ number_format($sell->other_charges,2) }}
                        </td>
                    </tr>

                    <tr>
                        <th>Discount</th>
                        <td class="text-end">
                            ₹{{ number_format($sell->discount,2) }}
                        </td>
                    </tr>

                    <tr class="table-success">

                        <th>
                            Grand Total
                        </th>

                        <th class="text-end">
                            ₹{{ number_format($sell->grand_total,2) }}
                        </th>

                    </tr>

                </table>

            </div>

        </div>

        <!-- Buttons -->
        <div class="text-center mt-4 no-print">

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

</body>
</html>