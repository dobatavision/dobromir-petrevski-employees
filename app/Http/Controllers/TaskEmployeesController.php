<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Exception;

class TaskEmployeesController extends Controller
{
    public function index()
    {
        return view('employees');
    }


    public function calc_data( $jsonData = [] )
    {
        $finalPairs = [];
        $daysWorkTogether = [];

        if(!empty($jsonData)){
            foreach ($jsonData as $emp1_key => $emp1) {
                // prevent duplicated combinations
                foreach (array_slice($jsonData, $emp1_key + 1) as $emp2) {
                    if ($emp1["EmpID"] != $emp2["EmpID"]) {
                        $dateFrom1 = strtotime($emp1["DateFrom"]);
                        $dateTo1 = ($emp1["DateTo"] === "NULL") ? time() : strtotime($emp1["DateTo"]);
                        $dateFrom2 = strtotime($emp2["DateFrom"]);
                        $dateTo2 = ($emp2["DateTo"] === "NULL") ? time() : strtotime($emp2["DateTo"]);

                        if ($emp1["ProjectID"] == $emp2["ProjectID"]) {
                            if ($dateTo1 >= $dateFrom2 && $dateTo2 >= $dateFrom1) {
                                $start = max($dateFrom1, $dateFrom2);
                                $end = min($dateTo1, $dateTo2);

                                $diffTime = $end - $start;
                                $diffDays = intval($diffTime / (60 * 60 * 24));
                                $pairId = $emp1["EmpID"] ."-". $emp2["EmpID"];

                                if (!isset($daysWorkTogether[$pairId])) {
                                    $daysWorkTogether[$pairId] = 0;
                                }
                                //sum common projectS
                                $daysWorkTogether[$pairId] += $diffDays;

                                if (!isset($finalPairs[$pairId])) {
                                    $finalPairs[$pairId] = [];
                                }
                                $finalPairs[$pairId][] = ["Employee ID #1" => $emp1["EmpID"], "Employee ID #2" => $emp2["EmpID"], "Project ID" => $emp1["ProjectID"], "Days worked" => $diffDays];

                            }
                        }
                    }
                }
            }
            arsort($daysWorkTogether);
            $pairWinId = key($daysWorkTogether);
            // dd($finalPairs["$pairWinId"]);
            return $finalPairs[$pairWinId];
        }
        return true;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');

        $csv = Reader::createFromPath($file, 'r');
        // $csv->setDelimiter(';');
        $csv->setHeaderOffset(0); // First row as headers
        // dd($csv);

        // Iterate through rows
        foreach ($csv as $row) {
            $jsonData[] = $row;
        }
        $finalResult = $this->calc_data($jsonData);

        return view('employees')->with('result', $finalResult);

        // return back()->withInput(["result"=>"asdasd"]);
        return response()->json(['result' => 'Abigail']);

        return redirect()->action([TaskEmployeesController::class, 'index']);
    }

}
