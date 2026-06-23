@component('mail::message')
<tr>
    <table>
        <h1 class="welcome-text"> New Invoice Generated</h1>
        <h2 class="pd-2">Dear {{ $invoice->Profile->full_name }},</h2>
        <p class="pd-2">This is a notice that an invoice has been generated for {{ $invoice->Bill->Client->Person->name }} on {{$invoice->created_at}}.</h3>
            <br><br>
    </table>

    <table>
        <tr>
            <th class="text-left">Invoice #:</th>
            <td class="text-right">{{ $invoice->invoice_ref }}</td>
        </tr>
        <tr>
            <th class="text-left">Amount:</th>
            <td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->InvoiceItems->sum('amount'),2)  }}</td>
        </tr>
        <tr>
            <th class="text-left">Due Date:</th>
            <td class="text-right">{{ $invoice->due_date }}</td>
        </tr>
    </table>

    <table class="table">


        <thead>
            <tr>
                <th>S/N </th>
                <th>DESCRIPTION </th>
                <th> QTY </th>
                <th> RATE </th>
                <th width="10%"> AMOUNT </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($invoice->InvoiceItems as $invoiceItem)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $invoiceItem->BillItem->Fee->FeeType->fee_type }}</td>
            <td>{{ $invoiceItem->quantity }}</td>
            <td>{{ number_format($invoiceItem->rate) }} </td>
            <td>{{ number_format($invoiceItem->amount) }}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>

            <tr>
                <td> </td>
                <td></td>
                <td colspan="2">Total:</td>
                <th>{{ $invoice->currency }} {{ number_format($invoice->InvoiceItems->sum('amount') + ($invoice->tax_value*$invoice->InvoiceItems->sum('amount')))  }}</th>
            </tr>
        </tfoot>
    </table>

    <p class="pd-2">You can login to your dashboard to view and pay the invoice @ <a href="{{url('/admin')}}">{{ config('app.name') }} Portal</a>.</h3>

</tr>

{{--
 @component('mail::button', ['url' => ''])
Verify
@endcomponent --}}

<p class="pd-2">
    Thanks, <br> {{ config('app.name') }}
</p>

@endcomponent

