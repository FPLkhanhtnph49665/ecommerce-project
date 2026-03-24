@if($status == 'pending')
    <span class="badge bg-warning">Chờ xử lý</span>
@elseif($status == 'confirmed')
    <span class="badge bg-primary">Đã xác nhận</span>
@elseif($status == 'shipping')
    <span class="badge bg-info">Đang giao</span>
@elseif($status == 'completed')
    <span class="badge bg-success">Hoàn thành</span>
@else
    <span class="badge bg-danger">Đã hủy</span>
@endif
