<?php

namespace App\Traits;

use App\Models\EmiDetails;
use App\Models\LoanDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;


trait LoanDetailsTraits {

    public function getLoanDetails() {
        return LoanDetails::get();
    }

    public function getDates($startDate, $endDate) {
        $dates    = [];

        if ($startDate && $endDate) {
            $startDate  = Carbon::parse($startDate);
            $endDate    = Carbon::parse($endDate);

            while ($startDate->lte($endDate)) {
                $dates[] = $startDate->format('Y-m-d');
                $startDate->addDays(30);
            }

        }

        return $dates;
    }

    public function calculateLoanEmi($loanAmount = 0, $noOfPayment = 0) {
        if ($loanAmount > 0 && $noOfPayment > 0) {
            return round((float)$loanAmount / $noOfPayment, 2);
        }
    }

    public function storeEmiDetails($data) {
        return EmiDetails::create($data);
    }

    public function getEmiDetailsToTable() {
        $tableHeaders   = [];
        $body           = [];

        if (Schema::hasTable('emi_details')) {
            $tableHeaders   = EmiDetails::getTableColumns();
            $body           = EmiDetails::all();
        }


        return ['header'=>$tableHeaders, 'tableBody' => $body];
    }


}

