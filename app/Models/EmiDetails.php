<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class EmiDetails extends Model
{
    use HasFactory;

    public static function getTableColumns() {
        return Schema::getColumnListing((new self())->getTable());
    }
}
