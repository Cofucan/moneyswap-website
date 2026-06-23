<?php

namespace App\Imports;

use App\Models\Revenue;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Traits\InvoiceTrait;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Date;
class RevenuesImport implements ToCollection, WithHeadingRow
{
    use InvoiceTrait;
    public function generateTransactionReference()
    {
        //$transaction_method = !empty($this->data['transaction_method']) ? $this->data['transaction_method'] : $this->data['payment_medium'];
        return 'SVIC-'.time();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $this->invoice = Invoice::where('invoice_ref', $row['invoice_ref'])->first();
            $transaction = Transaction::create([
                'academic_term_id'     => $this->invoice->Bill->academic_term_id,
                'transaction_type'    => 'Income',
                'transaction_method'    => $row['payment_method'],
                'approved_date'    => date("Y-m-d", strtotime($row['date_paid'])),
                'profile_id'    => $this->invoice->profile_id,
                'amount'    => $row['amount_paid'],
                'currency'    => $this->invoice->currency,
                'reference_code'    => $this->generateTransactionReference(),
                'status'    => 'Approved',                
            ]);
            $transaction->Invoices()->attach($this->invoice->id, [           
                'status' => 'Approved',
                'amount_applied' => $row['amount_paid']
                ]);
           
            $revenue = Revenue::create([
                'transaction_id'     => $transaction->id,
                'amount'  => $row['amount_paid'],
                'currency'    => $this->invoice->currency,
                'receipt_no'  => !empty($row['receipt_no']) ? $row['receipt_no'] : Null,                         
                'status'  => 'Approved'                
                ]);
            $this->CheckPayments();
        }
    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 20;
    }
}
