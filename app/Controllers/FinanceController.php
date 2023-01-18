<?php

namespace App\Controllers;

use App\Models\BalanceModel;
use App\Models\CashReportModel;
use App\Models\OrderModel;
use App\Models\PointConfigurationModel;
use App\Models\VendorModel;
use Exception;

class FinanceController extends BaseController
{
    public function cash()
    {
        return view('admin/finance/cash');
    }

    public function addCash($month)
    {
        return view('admin/finance/add_cash', compact('month'));
    }

    public function sales()
    {
        return view('admin/finance/sales');
    }

    public function salary()
    {
        return view('admin/finance/salary');
    }

    public function electrical()
    {
        return view('admin/finance/electrical');
    }

    public function rent()
    {
        return view('admin/finance/rent');
    }

    public function maintenance()
    {
        return view('admin/finance/maintenance');
    }

    public function other()
    {
        return view('admin/finance/other');
    }

    public function profitLoss()
    {
        if ($_SESSION['role'] != 'owner') {
            return redirect()
                ->to('access/forbidden');
        }
        return view('admin/finance/profit_loss');
    }

    public function searchSales()
    {
        $cashReportModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $order = $cashReportModel->monthSales($month)->getResultArray();
        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['created_at'] = date("d F Y", strtotime($order[$i]['created_at']));
            if ($order[$i]['debit'] == "") {
                $order[$i]['total_price'] = "(" . AdminController::money_format_rupiah($order[$i]['credit']) . ")";
            } else {
                $order[$i]['total_price'] = AdminController::money_format_rupiah($order[$i]['debit']);
            }
        }

        return json_encode($order);
    }

    public function searchCash()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $cash = $cashModel->cashReport($month)->getResultArray();

        for ($i = 0; $i < count($cash); $i++) {
            $cash[$i]['created_at'] = date("d F Y", strtotime($cash[$i]['created_at']));
            $cash[$i]['date'] = date("d F Y", strtotime($cash[$i]['date']));
            $cash[$i]['balance'] = AdminController::money_format_rupiah($cash[$i]['balance']);
            if (isset($cash[$i]['debit'])) {
                $cash[$i]['debit'] = AdminController::money_format_rupiah($cash[$i]['debit']);
                $cash[$i]['credit'] = "-";
            } else {
                $cash[$i]['credit'] = AdminController::money_format_rupiah($cash[$i]['credit']);
                $cash[$i]['debit'] = "-";
            }
        }

        return json_encode($cash);
    }

    public function searchProfitLoss()
    {
        $cashReportModel = new CashReportModel();
        $cashModel = new CashReportModel();
        $month = $this->request->getGet("month");

        $order = $cashReportModel->monthSales($month)->getResultArray();

        $total_sales = 0;
        for ($i = 0; $i < count($order); $i++) {
            if (isset($order[$i]['debit'])) {
                $total_sales = $total_sales + $order[$i]['debit'];
            } else {
                $total_sales = $total_sales - $order[$i]['credit'];
            }
        }
        $gross_sales = 30 / 100 * $total_sales;

        $total_sales = AdminController::money_format_rupiah($total_sales);
        $gross_sales = AdminController::money_format_rupiah($gross_sales);

        $salary = $cashModel->salaryReport($month)->getResultArray();

        $total_salary = 0;
        for ($i = 0; $i < count($salary); $i++) {
            if (isset($salary[$i]['credit'])) {
                $total_salary = $total_salary + $salary[$i]['credit'];
            } else {
                $total_salary = $total_salary - $salary[$i]['debit'];
            }
        }
        $total_salary = AdminController::money_format_rupiah($total_salary);

        $electrical = $cashModel->electricalReport($month)->getResultArray();

        $total_electrical = 0;
        for ($i = 0; $i < count($electrical); $i++) {
            if (isset($electrical[$i]['credit'])) {
                $total_electrical = $total_electrical + $electrical[$i]['credit'];
            } else {
                $total_electrical = $total_electrical - $electrical[$i]['debit'];
            }
        }
        $total_electrical = AdminController::money_format_rupiah($total_electrical);

        $rent = $cashModel->rentReport($month)->getResultArray();

        $total_rent = 0;
        for ($i = 0; $i < count($rent); $i++) {
            if (isset($rent[$i]['credit'])) {
                $total_rent = $total_rent + $rent[$i]['credit'];
            } else {
                $total_rent = $total_rent - $rent[$i]['debit'];
            }
        }
        $total_rent = AdminController::money_format_rupiah($total_rent);

        $maintenance = $cashModel->maintenanceReport($month)->getResultArray();

        $total_maintenance = 0;
        for ($i = 0; $i < count($maintenance); $i++) {
            if (isset($maintenance[$i]['credit'])) {
                $total_maintenance = $total_maintenance + $maintenance[$i]['credit'];
            } else {
                $total_maintenance = $total_maintenance - $maintenance[$i]['debit'];
            }
        }
        $total_maintenance = AdminController::money_format_rupiah($total_maintenance);

        $other = $cashModel->otherReport($month)->getResultArray();

        $total_other = 0;
        for ($i = 0; $i < count($other); $i++) {
            if (isset($other[$i]['credit'])) {
                $total_other = $total_other + $other[$i]['credit'];
            } else {
                $total_other = $total_other - $other[$i]['debit'];
            }
        }
        $total_other = AdminController::money_format_rupiah($total_other);

        $profit_loss[0]['description'] = "Total Sales";
        $profit_loss[0]['expenses_desc'] = "";
        $profit_loss[0]['amount1'] = $total_sales;
        $profit_loss[0]['amount2'] = "";

        $profit_loss[1]['description'] = "Gross Sales";
        $profit_loss[1]['expenses_desc'] = "";
        $profit_loss[1]['amount1'] = "";
        $profit_loss[1]['amount2'] = $gross_sales;

        $profit_loss[2]['description'] = "Expenses:";
        $profit_loss[2]['expenses_desc'] = "";
        $profit_loss[2]['amount1'] = "";
        $profit_loss[2]['amount2'] = "";

        $profit_loss[3]['description'] = "";
        $profit_loss[3]['expenses_desc'] = "Salary";
        $profit_loss[3]['amount1'] = "(" . $total_salary . ")";
        $profit_loss[3]['amount2'] = "";

        $profit_loss[4]['description'] = "";
        $profit_loss[4]['expenses_desc'] = "Electrical";
        $profit_loss[4]['amount1'] = "(" . $total_electrical . ")";
        $profit_loss[4]['amount2'] = "";

        $profit_loss[5]['description'] = "";
        $profit_loss[5]['expenses_desc'] = "Rent";
        $profit_loss[5]['amount1'] = "(" . $total_rent . ")";
        $profit_loss[5]['amount2'] = "";

        $profit_loss[6]['description'] = "";
        $profit_loss[6]['expenses_desc'] = "Maintenance";
        $profit_loss[6]['amount1'] = "(" . $total_maintenance . ")";
        $profit_loss[6]['amount2'] = "";

        $profit_loss[7]['description'] = "";
        $profit_loss[7]['expenses_desc'] = "Others";
        $profit_loss[7]['amount1'] = "(" . $total_other . ")";
        $profit_loss[7]['amount2'] = "";


        return json_encode($profit_loss);
    }

    public function searchProfitLossTotalExpenses()
    {
        $cashModel = new CashReportModel();
        $month = $this->request->getGet("month");

        $salary = $cashModel->salaryReport($month)->getResultArray();

        $total_salary = 0;
        for ($i = 0; $i < count($salary); $i++) {
            if (isset($salary[$i]['credit'])) {
                $total_salary = $total_salary + $salary[$i]['credit'];
            } else {
                $total_salary = $total_salary - $salary[$i]['debit'];
            }
        }

        $electrical = $cashModel->electricalReport($month)->getResultArray();

        $total_electrical = 0;
        for ($i = 0; $i < count($electrical); $i++) {
            if (isset($electrical[$i]['credit'])) {
                $total_electrical = $total_electrical + $electrical[$i]['credit'];
            } else {
                $total_electrical = $total_electrical - $electrical[$i]['debit'];
            }
        }

        $rent = $cashModel->rentReport($month)->getResultArray();

        $total_rent = 0;
        for ($i = 0; $i < count($rent); $i++) {
            if (isset($rent[$i]['credit'])) {
                $total_rent = $total_rent + $rent[$i]['credit'];
            } else {
                $total_rent = $total_rent - $rent[$i]['debit'];
            }
        }

        $maintenance = $cashModel->maintenanceReport($month)->getResultArray();

        $total_maintenance = 0;
        for ($i = 0; $i < count($maintenance); $i++) {
            if (isset($maintenance[$i]['credit'])) {
                $total_maintenance = $total_maintenance + $maintenance[$i]['credit'];
            } else {
                $total_maintenance = $total_maintenance - $maintenance[$i]['debit'];
            }
        }

        $other = $cashModel->otherReport($month)->getResultArray();

        $total_other = 0;
        for ($i = 0; $i < count($other); $i++) {
            if (isset($other[$i]['credit'])) {
                $total_other = $total_other + $other[$i]['credit'];
            } else {
                $total_other = $total_other - $other[$i]['debit'];
            }
        }

        $total_expenses = $total_salary + $total_electrical + $total_rent + $total_maintenance + $total_other;
        $total_expenses = "(" . AdminController::money_format_rupiah($total_expenses) . ")";

        return json_encode($total_expenses);
    }

    public function searchProfitLossTotalProfit()
    {
        $orderModel = new OrderModel();
        $cashModel = new CashReportModel();
        $month = $this->request->getGet("month");

        $order = $cashModel->monthSales($month)->getResultArray();

        $total_sales = 0;
        for ($i = 0; $i < count($order); $i++) {
            if (isset($order[$i]['debit'])) {
                $total_sales = $total_sales + $order[$i]['debit'];
            } else {
                $total_sales = $total_sales - $order[$i]['credit'];
            }
        }

        $gross_sales = 30 / 100 * $total_sales;

        $salary = $cashModel->salaryReport($month)->getResultArray();

        $total_salary = 0;
        for ($i = 0; $i < count($salary); $i++) {
            if (isset($salary[$i]['credit'])) {
                $total_salary = $total_salary + $salary[$i]['credit'];
            } else {
                $total_salary = $total_salary - $salary[$i]['debit'];
            }
        }

        $electrical = $cashModel->electricalReport($month)->getResultArray();

        $total_electrical = 0;
        for ($i = 0; $i < count($electrical); $i++) {
            if (isset($electrical[$i]['credit'])) {
                $total_electrical = $total_electrical + $electrical[$i]['credit'];
            } else {
                $total_electrical = $total_electrical - $electrical[$i]['debit'];
            }
        }

        $rent = $cashModel->rentReport($month)->getResultArray();

        $total_rent = 0;
        for ($i = 0; $i < count($rent); $i++) {
            if (isset($rent[$i]['credit'])) {
                $total_rent = $total_rent + $rent[$i]['credit'];
            } else {
                $total_rent = $total_rent - $rent[$i]['debit'];
            }
        }

        $maintenance = $cashModel->maintenanceReport($month)->getResultArray();

        $total_maintenance = 0;
        for ($i = 0; $i < count($maintenance); $i++) {
            if (isset($maintenance[$i]['credit'])) {
                $total_maintenance = $total_maintenance + $maintenance[$i]['credit'];
            } else {
                $total_maintenance = $total_maintenance - $maintenance[$i]['debit'];
            }
        }

        $other = $cashModel->otherReport($month)->getResultArray();

        $total_other = 0;
        for ($i = 0; $i < count($other); $i++) {
            if (isset($other[$i]['credit'])) {
                $total_other = $total_other + $other[$i]['credit'];
            } else {
                $total_other = $total_other - $other[$i]['debit'];
            }
        }

        $total_expenses = $total_salary + $total_electrical + $total_rent + $total_maintenance + $total_other;
        $profit_loss = $gross_sales - $total_expenses;

        if ($profit_loss < 0) {
            $profit_loss = "(" . AdminController::money_format_rupiah($profit_loss) . ")";
        } else {
            $profit_loss = AdminController::money_format_rupiah($profit_loss);
        }
        return json_encode($profit_loss);
    }

    public function searchSalary()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $salary = $cashModel->salaryReport($month)->getResultArray();

        for ($i = 0; $i < count($salary); $i++) {
            $salary[$i]['created_at'] = date("d F Y", strtotime($salary[$i]['created_at']));
            $salary[$i]['date'] = date("d F Y", strtotime($salary[$i]['date']));
            $salary[$i]['balance'] = AdminController::money_format_rupiah($salary[$i]['balance']);
            if (isset($salary[$i]['debit'])) {
                $salary[$i]['amount'] = "(" . AdminController::money_format_rupiah($salary[$i]['debit']) . ")";
            } else {
                $salary[$i]['amount'] = AdminController::money_format_rupiah($salary[$i]['credit']);
            }
        }

        return json_encode($salary);
    }

    public function searchSalaryTotal()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $salary = $cashModel->salaryReport($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($salary); $i++) {
            if (isset($salary[$i]['credit'])) {
                $total = $total + $salary[$i]['credit'];
            } else {
                $total = $total - $salary[$i]['debit'];
            }
        }
        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchElectrical()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $electrical = $cashModel->electricalReport($month)->getResultArray();

        for ($i = 0; $i < count($electrical); $i++) {
            $electrical[$i]['created_at'] = date("d F Y", strtotime($electrical[$i]['created_at']));
            $electrical[$i]['date'] = date("d F Y", strtotime($electrical[$i]['date']));
            $electrical[$i]['balance'] = AdminController::money_format_rupiah($electrical[$i]['balance']);
            if (isset($electrical[$i]['debit'])) {
                $electrical[$i]['amount'] = "(" . AdminController::money_format_rupiah($electrical[$i]['debit']) . ")";
            } else {
                $electrical[$i]['amount'] = AdminController::money_format_rupiah($electrical[$i]['credit']);
            }
        }

        return json_encode($electrical);
    }

    public function searchElectricalTotal()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $electrical = $cashModel->electricalReport($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($electrical); $i++) {
            if (isset($electrical[$i]['credit'])) {
                $total = $total + $electrical[$i]['credit'];
            } else {
                $total = $total - $electrical[$i]['debit'];
            }
        }
        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchRent()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $rent = $cashModel->rentReport($month)->getResultArray();

        for ($i = 0; $i < count($rent); $i++) {
            $rent[$i]['created_at'] = date("d F Y", strtotime($rent[$i]['created_at']));
            $rent[$i]['date'] = date("d F Y", strtotime($rent[$i]['date']));
            $rent[$i]['balance'] = AdminController::money_format_rupiah($rent[$i]['balance']);
            if (isset($rent[$i]['debit'])) {
                $rent[$i]['amount'] = "(" . AdminController::money_format_rupiah($rent[$i]['debit']) . ")";
            } else {
                $rent[$i]['amount'] = AdminController::money_format_rupiah($rent[$i]['credit']);
            }
        }

        return json_encode($rent);
    }

    public function searchRentTotal()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $rent = $cashModel->rentReport($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($rent); $i++) {
            if (isset($rent[$i]['credit'])) {
                $total = $total + $rent[$i]['credit'];
            } else {
                $total = $total - $rent[$i]['debit'];
            }
        }
        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchMaintenance()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $maintenance = $cashModel->maintenanceReport($month)->getResultArray();

        for ($i = 0; $i < count($maintenance); $i++) {
            $maintenance[$i]['created_at'] = date("d F Y", strtotime($maintenance[$i]['created_at']));
            $maintenance[$i]['date'] = date("d F Y", strtotime($maintenance[$i]['date']));
            $maintenance[$i]['balance'] = AdminController::money_format_rupiah($maintenance[$i]['balance']);
            if (isset($maintenance[$i]['debit'])) {
                $maintenance[$i]['amount'] = "(" . AdminController::money_format_rupiah($maintenance[$i]['debit']) . ")";
            } else {
                $maintenance[$i]['amount'] = AdminController::money_format_rupiah($maintenance[$i]['credit']);
            }
        }

        return json_encode($maintenance);
    }

    public function searchMaintenanceTotal()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $maintenance = $cashModel->maintenanceReport($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($maintenance); $i++) {
            if (isset($maintenance[$i]['credit'])) {
                $total = $total + $maintenance[$i]['credit'];
            } else {
                $total = $total - $maintenance[$i]['debit'];
            }
        }
        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchOther()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $other = $cashModel->otherReport($month)->getResultArray();

        for ($i = 0; $i < count($other); $i++) {
            $other[$i]['created_at'] = date("d F Y", strtotime($other[$i]['created_at']));
            $other[$i]['date'] = date("d F Y", strtotime($other[$i]['date']));
            $other[$i]['balance'] = AdminController::money_format_rupiah($other[$i]['balance']);
            if (isset($other[$i]['debit'])) {
                $other[$i]['amount'] = "(" . AdminController::money_format_rupiah($other[$i]['debit']) . ")";
            } else {
                $other[$i]['amount'] = AdminController::money_format_rupiah($other[$i]['credit']);
            }
        }

        return json_encode($other);
    }

    public function searchOtherTotal()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $other = $cashModel->otherReport($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($other); $i++) {
            if (isset($other[$i]['credit'])) {
                $total = $total + $other[$i]['credit'];
            } else {
                $total = $total - $other[$i]['debit'];
            }
        }
        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchFirstBalance()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $cash = $cashModel->cashReport($month)->getResultArray();
        if (!isset($cash[0]['credit'])) {
            $first_balance = $cash[0]['balance'] - $cash[0]['debit'];
        } else {
            $first_balance = $cash[0]['balance'] + $cash[0]['credit'];
        }

        $first_balance = AdminController::money_format_rupiah($first_balance);

        $result['first_balance'] = $first_balance;

        return json_encode($result);
    }

    public function searchSalesTotal()
    {
        $cashReportModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $order = $cashReportModel->monthSales($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($order); $i++) {
            $total = $total + $order[$i]['debit'];
        }

        for ($i = 0; $i < count($order); $i++) {
            $total = $total - $order[$i]['credit'];
        }

        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchConfig()
    {
        $pointConfigModel = new PointConfigurationModel();

        $point = $pointConfigModel->where('deleted_at', NULL)
            ->findAll();

        for ($i = 0; $i < count($point); $i++) {
            if (isset($point[$i]['updated_at'])) {

                $point[$i]['date'] = date("d F Y", strtotime($point[$i]['updated_at']));
                $point[$i]['time'] = date("H:i", strtotime($point[$i]['updated_at']));
            } else {
                $point[$i]['date'] = "No Update Yet";
            }
            $point[$i]['value'] = AdminController::money_format_rupiah($point[$i]['value']);
        }

        return json_encode($point);
    }

    public function storeCash()
    {
        $session = session();
        $cashReportModel = new CashReportModel();
        $balanceModel = new BalanceModel();
        $data = $this->request->getPost();
        try {
            $balance = $balanceModel->where('id', 1)->first();

            if ($data['cash_debit_credit'] == "debit") {
                $new_balance = (int) $balance['balance'] + (int) $data['cash_amount'];
                $data_insert_cash = [
                    'description' => $data['cash_description'],
                    'debit' => $data['cash_amount'],
                    'balance' => $new_balance,
                    'type' => $data['cash_type'],
                    'date' => $data['cash_date'],
                    'user_id' => $_SESSION['id'],
                ];
            } else {
                $new_balance = (int) $balance['balance'] - (int) $data['cash_amount'];
                $data_insert_cash = [
                    'description' => $data['cash_description'],
                    'credit' => $data['cash_amount'],
                    'balance' => $new_balance,
                    'type' => $data['cash_type'],
                    'date' => $data['cash_date'],
                    'user_id' => $_SESSION['id'],
                ];
            }

            $data_update_balance = [
                'balance' => $new_balance,
            ];
            $cashReportModel->insert($data_insert_cash);
            $balanceModel->update(1, $data_update_balance);

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/finance/cash'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
            return redirect()->to(base_url('admin/finance/add_cash') . "/" . $data['cash_month']);
        }
    }

    public function delete($id)
    {
        $session = session();
        $vendorModel = new VendorModel();

        $data = [
            'is_active' => 0
        ];

        $vendorModel->update($id, $data);
        $vendor = $vendorModel->where('id', $id)->first();

        $vendorModel->where('id', $id)->delete();

        $session->setFlashdata('deleteVendor', '.');

        return view('admin/vendor/index', compact('vendor'));
    }
}
