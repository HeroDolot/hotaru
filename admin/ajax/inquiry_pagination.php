<?php
// load_inquiries.php
include '../../connection.php';
$sql = "SELECT * FROM inquiry";
$inquiriesPerPage = 10;
$current_page = isset($_POST['page']) ? $_POST['page'] : 1;

// Your existing code to fetch $inquiries from the database or another source
$inquiries = isset($inquiries) && is_array($inquiries) ? $inquiries : [];

$totalInquiries = count($inquiries);

$start = ($current_page - 1) * $inquiriesPerPage;
$html = '';

for ($i = $start; $i < min($start + $inquiriesPerPage, $totalInquiries); $i++) {
    $inquiry = $inquiries[$i];
    $inq_id = $inquiry['inquiry_id'];
    $modalId = 'myModal_' . $inquiry['inquiry_id'];

    if ($inquiry["inquiry_status"] == 0) {
        $html .= '<tr>';
        $html .= '<td>' . $inquiry['client_name'] . '</td>';
        $html .= '<td>' . $inquiry['client_number'] . '</td>';
        $html .= '<td>' . $inquiry['client_region'] . '</td>';
        $html .= '<td>' . $inquiry['client_wo'] . '</td>';
        $html .= '<td>Call</td>';
        $html .= '<td>';
        $html .= '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
        $html .= '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">';
        $html .= '<i class="fa fa-check fa-solid"></i>';
        $html .= '</button>';
        $html .= '<div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        $html .= '<div class="modal-dialog">';
        $html .= '<div class="modal-content">';
        $html .= '<div class="modal-header">';
        $html .= '<h5 class="modal-title" id="exampleModalLabel">Approving</h5>';
        $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        $html .= '</div>';
        $html .= '<div class="modal-body">';
        $html .= '<form method="POST">';
        $html .= '<input type="hidden" name="inquiry_id" value="' . $inq_id . '">';
        $html .= '<div class="mb-3 form-floating">';
        $html .= '<input type="text" class="form-control fw-bolder" required id="clientName" name="name" placeholder="Client Name" value="' . $inquiry['client_name'] . '" readonly>';
        $html .= '<label for="clientName">Client Name</label>';
        $html .= '</div>';
        $html .= '<div class="mb-3 form-floating">';
        $html .= '<input type="text" class="form-control fw-bolder" required id="clientLocation" name="location" placeholder="Location">';
        $html .= '<label for="clientLocation">Location</label>';
        $html .= '</div>';
        $html .= '<div class="mb-3 form-floating">';
        $html .= '<input type="date" class="form-control fw-bolder" required id="dateStart" name="start_date">';
        $html .= '<label for="dateStart">Date Start</label>';
        $html .= '</div>';
        $html .= '<div class="mb-3 form-floating">';
        $html .= '<input type="number" class="form-control fw-bolder" required id="contractAmount" name="contract" placeholder="Contract Amount">';
        $html .= '<label for="contractAmount">Contract Amount</label>';
        $html .= '</div>';
        $html .= '<div class="mb-3 form-floating">';
        $html .= '<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" readonly></textarea>';
        $html .= '<label for="floatingTextarea2">Context</label>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="modal-footer">';
        $html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        $html .= '<button type="submit" name="submit_contract" class="btn btn-primary">Submit Contract</button>';
        $html .= '</form>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<form method="POST">';
        $html .= '<input type="hidden" name="inquiry_id" value="' . $inq_id . '">';
        $html .= '<button class="btn btn-danger" type="submit" name="inquiry_decline">';
        $html .= '<li class="fa fa-trash fa-solid"></li>';
        $html .= '</button>';
        $html .= '</form>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }
}

echo $html;
?>
