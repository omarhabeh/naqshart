<?php

namespace App\Http\Controllers;

use App\Exports\InvitationExport;
use App\Invitations;
use Illuminate\Http\Request;
use DB;
use Excel;

class InvitationController extends Controller
{
    public function index() {
        $invitations = Invitations::all();
        return view('invitations.index', compact('invitations'));
    }

    public function excel() {
        return Excel::download(new InvitationExport, 'invitations.xlsx');
    }
        public function csv(Request $request) {
        $fileName = 'invitations.csv';
        $invitations = Invitations::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Email', 'Phone', 'Country', 'Programs');

        $callback = function() use($invitations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($invitations as $invitation) {
                $row['Name']  = $invitation->name;
                $row['Email']    = $invitation->email;
                $row['Phone']    = $invitation->phone;
                $row['Country']  = $invitation->country;
                $row['Programs']  = $invitation->programs;

                fputcsv($file, array($row['Name'], $row['Email'], $row['Phone'], $row['Country'], $row['Programs']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
