@extends('layout')
@section('content')
<style>
.table-container {
    margin: 0 auto;
    width: 95%;
}
.add-user-and-search {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
.add-user-button {
    display: flex;
    justify-content: flex-end;
}
.add-user-button .btn:hover {
    background-color: #0047b3;
    color: white;
}
th {
    text-align: left;
}
td button {
    margin-right: 5px;
}
.button-container {
    display: flex;
    align-items: center;
}
.button-container button,
.button-container a {
    margin-right: 5px; /* Space between the buttons */
}
/* .btn-primary{
    background-color: #cc2c2c;
    border-color: #cc2c2c;

} */
/* .btn-primary:hover{
    background-color: #cc2c2c;
    border-color: #cc2c2c;

} */
</style>

<div class="table-container">
    <div class="add-user-and-search">
        <div class="dataTables_filter" id="files_list_filter">

        </div>
        <div class="add-user-button">
            <a href="adduser" class="btn btn-primary waves-effect waves-light">
                <i class="ti ti-plus"></i> إضافة مستخدم
            </a>
        </div>
    </div>

    <!-- Table container -->
    <table id="files_list"class="display">
        <thead>
            <tr>
            <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>رقم البطاقة الوطنية</th>
                <th>العمر</th>
                <th>الجنس</th>
                <th>دور المستخدم</th>
                <th>قسم</th>
                <th>إجراء</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->cin}}</td>
                <td>{{$user->age}}</td>
                <td>{{$user->genre}}</td>
                <td>{{$user->role}}</td>
                <td>{{ $user->department->name ?? 'لم يحدد بعد' }}</td>
                <td>
                <div class="button-container">
<!-- edit -->
                    <a href="{{ url('edituser')}}/{{$user->id}}/update">
                        <button class="btn rounded-pill btn-outline-info waves-effect" title="Edit">
                            <i class="ti ti-edit"></i>
                        </button>
                    </a>
<!-- delete -->
                    <a href="#" class="btn rounded-pill btn-outline-danger waves-effect" title="Delete"
                        onclick="event.preventDefault(); if(confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟')) { document.getElementById('delete-user-{{ $user->id }}').submit(); }">
                        <i class="ti ti-trash"></i>
                    </a>

                    <!-- Hidden form that will be submitted when the link is clicked -->
                    <form id="delete-user-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#files_list').DataTable({
        "aLengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
        ],
        "iDisplayLength": 10,

        "language": {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
});
</script>
@endsection
