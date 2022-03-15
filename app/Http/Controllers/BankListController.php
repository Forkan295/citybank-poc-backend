<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankList;

class BankListController extends Controller
{
    public function index()
    {
    	$lists = BankList::paginate();

    	return view('list.bank-list', compact('lists'));
    }
}
