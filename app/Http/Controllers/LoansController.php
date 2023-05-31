<?php

namespace App\Http\Controllers;

use App\Models\LoanDetails;
use App\Traits\LoanDetailsTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoansController extends Controller
{
    use LoanDetailsTraits;


    public function index() {
        $parameters = [
            'loanDetails'   => $this->getLoanDetails()
        ];

        return view('loans.index', $parameters);
    }

    public function showEMIDetails() {
        $parameters = [
            'emiDetails'    => $this->getEmiDetailsToTable()
        ];

        return view('loans.emi', $parameters);
    }

    public function createEMIDetails() {
        $this->createEMIDetailsTable();

        return redirect()->route('loans.emi.details');
    }

    public function createEMIDetailsTable() {
        $firstPaymentDate   = LoanDetails::min('first_payment_date');
        $lastPaymentDate    = LoanDetails::max('last_payment_date');
        $dateColumns        = $this->getDates($firstPaymentDate, $lastPaymentDate);
        $query              = '';

        if ($dateColumns) {
            DB::statement("DROP TABLE  IF EXISTS  emi_details");

            $query .= "CREATE TABLE emi_details(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, client_id INT(10) NOT NULL";
            foreach($dateColumns as $index => $columnName) {
                $fields = Carbon::parse($columnName)->format('Y_M');
                $query .= ", `".$fields."` DOUBLE(8,2) NULL DEFAULT 0";
            }

            $query .= ")";

            DB::statement($query);
        }

        $this->storeEMIDetails($dateColumns);


    }

    public function storeEMIDetails($dateColumns) {
        $loanDetails    = $this->getLoanDetails();

        if ($loanDetails) {
            foreach ($loanDetails as $index=> $loan) {
                $loanAmount = $loan['loan_amount'];
                $emi        = $this->calculateLoanEmi($loanAmount , $loan['num_of_payment']);
                $emiDates   = $this->getDates($loan['first_payment_date'], $loan['last_payment_date']);
                $data       = [];

                if ($emiDates) {
                    $data['client_id'] = $loan['client_id'];

                    foreach ($emiDates as $date) {
                        $emiPaid    = ($emi < $loanAmount)?$emi:$loanAmount;
                        $loanAmount -= $emi;
                        $data[Carbon::parse($date)->format('Y_M')]   = $emiPaid;
                        //$this->storeEMIDetails($data);
                    }
                    DB::table('emi_details')->insert($data);
                }
            }
        }
    }
}
