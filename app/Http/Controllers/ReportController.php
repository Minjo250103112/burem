<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $bulans =[
            [
                'no' => '01',
                'nama' => 'Januari',
            ],
            [
                'no' => '02',
                'nama' => 'Februari',
            ],
            [
                'no' => '03',
                'nama' => 'Maret',
            ],
            [
                'no' => '04',
                'nama' => 'April',
            ],
            [
                'no' => '05',
                'nama' => 'Mei',
            ],
            [
                'no' => '06',
                'nama' => 'Juni',
            ],
            [
                'no' => '07',
                'nama' => 'Juli',
            ],
            [
                'no' => '08',
                'nama' => 'Agustus',
            ],
            [
                'no' => '09',
                'nama' => 'September',
            ],
            [
                'no' => '10',
                'nama' => 'Oktober',
            ],
            [
                'no' => '11',
                'nama' => 'November',
            ],
            [
                'no' => '12',
                'nama' => 'Desember',
            ],
        ];

        $tahuns = [2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030];

        $data = [];
        $bulan_now = Carbon::now()->format('m');
        $tahun_now = Carbon::now()->format('Y');

        // Ambil bulan & tahun dari request, fallback ke sekarang jika null
        $getbulan = empty($request->get('bulan')) ? $bulan_now : $request->get('bulan');
        $gettahun = empty($request->get('tahun')) ? $tahun_now : $request->get('tahun');
        // $tahun = $request->get('tahun', $tahun_now);

        // Tanggal awal bulan
        $today = Carbon::parse("$gettahun-$getbulan-01");

        // Ambil semua tiket dalam bulan & tahun tersebut
        $tikets = Ticket::whereMonth('created_at', $getbulan)
            ->whereYear('created_at', $gettahun)
            ->orderBy('created_at', 'ASC')
            ->get();

        // Kelompokkan tiket berdasarkan tanggal (Y-m-d)
        $groupedByDate = $tikets->groupBy(function ($ticket) {
            return Carbon::parse($ticket->created_at)->toDateString();
        });

        // Loop setiap tanggal dalam bulan
        for ($i = 1; $i <= $today->daysInMonth; ++$i) {
            $date = Carbon::createFromDate($today->year, $today->month, $i)->toDateString();

            $ticketsOnDate = $groupedByDate->get($date, collect());

            $customers = $ticketsOnDate->groupBy('customer_id')->map->count();
            $ticketCount = $ticketsOnDate->count();
            $done = $ticketsOnDate->where('status', 2)->map->count();

            $data[] = [
                'tanggal' => Carbon::parse($date)->translatedFormat('d F Y'),
                'customers' => collect($customers)->count(),
                'tickets' => $ticketCount,
                'done' => collect($done)->count(),
            ];
        }

        return view('layouts.pages.report.index', compact(['data', 'bulans', 'tahuns', 'getbulan', 'gettahun']));
    }
}
