<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/DashBoard.php';
class DashBoardController {
    private $db;
    private $dashboardModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->dashboardModel = new DashBoard($this->db);
    }

    public function getall() {
        $visitbydate= $this->dashboardModel->getVisitCountByDay()->fetch(PDO::FETCH_ASSOC);
        $visitbyweek= $this->dashboardModel->getVisitCountByWeek()->fetch(PDO::FETCH_ASSOC);
        $visitbymonth= $this->dashboardModel->getVisitCountByMonth()->fetch(PDO::FETCH_ASSOC);

        $solditemsbydate= $this->dashboardModel->getSoldItemsByDate()->fetch(PDO::FETCH_ASSOC);
        $solditemsbyweek= $this->dashboardModel->getSoldItemsByWeek()->fetch(PDO::FETCH_ASSOC);
        $solditemsbymonth= $this->dashboardModel->getSoldItemsByMonth()->fetch(PDO::FETCH_ASSOC);

        $incomebydate= $this->dashboardModel->getIncomeByDate()->fetch(PDO::FETCH_ASSOC);
        $incomebyweek= $this->dashboardModel->getIncomeByWeek()->fetch(PDO::FETCH_ASSOC);
        $incomebymonth= $this->dashboardModel->getIncomeByMonth()->fetch(PDO::FETCH_ASSOC);

        $orderstatusbydatetemp= $this->dashboardModel->getOderStatusByDate()->fetchAll(PDO::FETCH_ASSOC);
        $orderstatusbyweektemp= $this->dashboardModel->getOderStatusByWeek()->fetchAll(PDO::FETCH_ASSOC);
        $orderstatusbymonthtemp= $this->dashboardModel->getOderStatusByMonth()->fetchAll(PDO::FETCH_ASSOC);

        $fixedStatuses = ['Chờ xác nhận', 'Đang giao', 'Đã giao', 'Đã hủy'];

        $orderstatusbydate = array_fill_keys($fixedStatuses, 0);
        $orderstatusbyweek = array_fill_keys($fixedStatuses, 0);
        $orderstatusbymonth = array_fill_keys($fixedStatuses, 0);

        foreach ($orderstatusbydatetemp as $statusData) {
            $status = $statusData['status'];
            $count = $statusData['order_count'];
            if (isset($orderstatusbydate[$status])) {
                $orderstatusbydate[$status] = $count;
            }
        }
        foreach ($orderstatusbyweektemp as $statusData) {
            $status = $statusData['status'];
            $count = $statusData['order_count'];
            if (isset($orderstatusbyweek[$status])) {
                $orderstatusbyweek[$status] = $count;
            }
        }
        foreach ($orderstatusbymonthtemp as $statusData) {
            $status = $statusData['status'];
            $count = $statusData['order_count'];
            if (isset($orderstatusbymonth[$status])) {
                $orderstatusbymonth[$status] = $count;
            }
        }

        $reviewbydate= $this->dashboardModel->getReviewByDate()->fetch(PDO::FETCH_ASSOC);
        $reviewbyweek= $this->dashboardModel->getReviewByWeek()->fetch(PDO::FETCH_ASSOC);
        $reviewbymonth= $this->dashboardModel->getReviewByMonth()->fetch(PDO::FETCH_ASSOC);
        

        $data= [
            'visitbydate' => $visitbydate,
            'visitbyweek' => $visitbyweek,
            'visitbymonth' => $visitbymonth,
            'solditemsbydate' => $solditemsbydate,
            'solditemsbyweek' => $solditemsbyweek,
            'solditemsbymonth' => $solditemsbymonth,
            'incomebydate' => $incomebydate,
            'incomebyweek' => $incomebyweek,
            'incomebymonth' => $incomebymonth,
            'orderstatusbydate' => $orderstatusbydate,
            'orderstatusbyweek' => $orderstatusbyweek,
            'orderstatusbymonth' => $orderstatusbymonth,
            'reviewbydate' => $reviewbydate,
            'reviewbyweek' => $reviewbyweek,
            'reviewbymonth' => $reviewbymonth,
        ];

        include_once __DIR__ . '../../../views/admin/admin_dashboard.php';
    }    
}
?>