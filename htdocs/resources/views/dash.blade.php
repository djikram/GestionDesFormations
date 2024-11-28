@extends('layout')
@section('content')

<style>
.table-container {
    margin: 0 auto;
    width: 95%;
}
.dataTables_length {
    margin-bottom: 15px;
}
.dataTables_filter {
    float: left;
}
.pagination {
    float: right;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    direction: rtl;
}
.cards-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}
.card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
}
.card h3 {
    margin: 0 0 20px;
    color: #333;
    font-size: 1.5em;
}
.search-bar {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: flex-end;
}
.search-bar label {
    margin-left: 10px;
    text-align: right;
}
.search-bar input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: right;
    direction: rtl;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}
table thead th {
    text-align: right;
    font-size: 1em;
    color: #555;
    border-bottom: 2px solid #ddd;
    padding: 10px 5px;
}
table tbody td {
    padding: 15px;
    font-size: 1em;
    color: #444;
    text-align: right;
    vertical-align: middle;
}
table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}
.status {
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.9em;
    color: white;
}
.status.confirm {
    background-color: #28a745;
}
.status.pending {
    background-color: #ffc107;
    color: black;
}
</style>

<div class="cards-container">
    <!-- Evaluated Courses -->
    <div class="card">
        <h3>التكوينات المُقَيَّمة</h3>
        <div class="table-container">
        <table id="evaluatedCoursesTable" class="display">
            <thead>
                <tr>
                    <th>محاور التكوين</th>
                    <th>عدد المستفيدين</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @forelse($evaluatedCourses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->personnelsCount() ?? 'لم يحدد بعد' }}</td>
                    <td><span class="status confirm">مُقَيَّمة</span></td>
                    <td>
                        <a href="{{ route('evaluation.show', ['courseId' => $course->id]) }}">
                            <button class="btn rounded-pill btn-outline-info waves-effect dropdown-item" title="Edit">
                                <i class="ti ti-eye"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">لا توجد دورات تم تقييمها بعد.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
    <!-- Non-Evaluated Courses -->
    <div class="card">
        <h3>التكوينات في انتظار التقييم</h3>
        <div class="table-container">
        <table id="nonEvaluatedCoursesTable" class="display">
            <thead>
                <tr>
                    <th>محاور التكوين</th>
                    <th>عدد المستفيدين</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nonEvaluatedCourses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->personnelsCount() ?? 'لم يحدد بعد' }}</td>
                    <td><span class="status pending">قيد الانتظار</span></td>
                    <td>
                    <a href="{{ route('evaluation.show', ['courseId' => $course->id]) }}">
                            <button class="btn rounded-pill btn-outline-info waves-effect dropdown-item" title="Edit">
                                <i class="ti ti-eye"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No non-evaluated courses available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTables for Evaluated Courses
    $('#evaluatedCoursesTable').DataTable({
        "aLengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sSearch": "ابحث:",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        },
        "columnDefs": [
            { "searchable": false, "targets": 2 }
        ]
    });
    $('#nonEvaluatedCoursesTable').DataTable({
        "aLengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sSearch": "ابحث:",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        },
        "columnDefs": [
            { "searchable": false, "targets": 2 }
        ]
    });
});
</script>




@endsection
