<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HumanResourceController extends Controller
{
    // public function payroll(Request $request)
    // {
    //     $age = $request->age;

    //     return response() ->json([
    //         "age" => $age
    //     ]);
    // }

    public function payroll(Request $request)
    {
        $employmentType = "$request->employmentType";
        $positionTier = "$request->positionTier";
        $daysAbsent = $request->daysAbsent;
        $minutesLate = $request->minutesLate;
        $overtimeHours = $request->overtimeHours;
        $sss;
        $philhealth;
        $pagIbig;

        if($employmentType == "COS")
        {
            $positionTier = "None";
            $monthlyBaseSalary = 18000.00;
            $sss = 0.00;
            $philhealth = 0.00;
            $pagIbig = 0.00;
        }
        else if($employmentType == "Regular" && $positionTier == "Junior"){
            $positionTier = "Junior";
            $monthlyBaseSalary = 25000.00;
            $sss = 1125.00;
            $philhealth = 625.00;
            $pagIbig = 200.00;
        }
        else{
            $positionTier = "Senior";
            $monthlyBaseSalary = 40000.00;
            $sss = 1800.00;
            $philhealth = 1000.00;
            $pagIbig = 200.00;
        }

        $daysPresent = 22 - $daysAbsent;
        $dailyRate = $monthlyBaseSalary / 22;
        $hourlyRate = $dailyRate / 8;
        $lateDeduction = ($hourlyRate / 60) * $minutesLate;
        $absentDeduction = $dailyRate * $daysAbsent;
        $overtimePay = $overtimeHours * ($hourlyRate * 1.25);
        $grossPay = $monthlyBaseSalary - $lateDeduction - $absentDeduction + $overtimePay;
        $totalDeductions = $sss + $philhealth + $pagIbig;
        $netPay = $grossPay - $totalDeductions;

        return response() ->json([
                "daysAbsent" =>$daysAbsent,
                "employmentType" =>$employmentType,
                "positionTier" =>$positionTier,
                "baseSalary" =>round($monthlyBaseSalary, 2),
                "daysPresent" =>$daysPresent,
                "dailyRate" =>round($dailyRate, 2),
                "lateDeduction" =>round($lateDeduction,2),
                "absentDeduction" =>round($absentDeduction, 2),
                "overtimePay" =>round($overtimePay, 2),
                "grossPay" =>round($grossPay, 2),
                "sss" =>round($sss, 2),
                "philHealth" =>round($philhealth, 2),
                "pagibig" =>round($pagIbig, 2),
                "totalDeductions" =>round($totalDeductions,2),
                "netPay" =>round($netPay, 2),
            ]);
    }
}
