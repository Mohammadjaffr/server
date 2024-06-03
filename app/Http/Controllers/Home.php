<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\invoice_iss;
use App\Models\invoiceissue;
use App\Models\receivinginvoice;
use App\Models\vendor;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $rec=receivinginvoice::count();
        $iss=invoice_iss::count();
        $vend=vendor::count();
        $clie=client::count();

        $x=(($rec/($rec+$iss))*100);
        $y=(($iss/($rec+$iss))*100);
        $c=(($clie/($vend+$clie))*100);
        $v=(($vend/($vend+$clie))*100);
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['reciveing', 'issuing','vendor', 'client',])
            ->datasets([
                [
                    "label" => "reciveing",
                    'backgroundColor' => ['#057be6'],
                    'data' => [$x]
                ],
                [
                    "label" => "issuing",
                    'backgroundColor' => ['#f84664'],
                    'data' => [$y]
                ],
                [
                    "label" => "vendor",
                    'backgroundColor' => ['#14a777'],
                    'data' => [$v]
                ],
                [
                    "label" => "client",
                    'backgroundColor' => ['#f67233'],
                    'data' => [$c]
                ],


            ])
            ->options([]);
       return view('home.index', compact('chartjs', ));

        return view('home.index', );
    }






}
