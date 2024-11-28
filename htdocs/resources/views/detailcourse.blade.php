@extends('layout')
@section('content')
<style>
.table-container {
    margin: 0 auto;
    width: 95%;
}

.add-course-and-search {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

/* .add-course-button {
    display: flex;
    justify-content: flex-end;
}
.add-course-button .btn:hover {
    background-color: #0047b3;
    color: white;
} */
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
    margin-right: 5px;
}

.btn-view {
    border-color: #4CAF50;
    color: #4CAF50;
}

.title {
    text-align: right;
    padding-left: 300px;
    font-size: 24px;
    font-weight: bold;
}
</style>

<div class="table-container">
    <div class="add-course-and-search">
        <div class="dataTables_filter" id="files_list_filter">

        </div>
        <!-- <div class="add-course-button">
            <a href="#" class="btn btn-primary waves-effect waves-light">
                <i class="ti ti-plus"></i> إضافة دورة
            </a>
        </div> -->
        <h2 class="title">تفاصيل التكوين :</h2>

        <a href="{{ url('courses')}}">التكوين: {{$course->name}}</a>
    </div>

    <!-- Table container -->
    <table id="files_list" class="display">
        <thead>
            <tr>
                <!-- <th>الوصف</th> -->
                <th>المدربين</th>
                <th>المستفدين</th>
                <th>تاريخ البدء</th>
                <th>تاريخ الانتهاء</th>
                <th>العروض</th>
                <th>الصور</th>
                <th>عدد الرجال</th>
                <th>عدد النساء</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @if($formateurs->isNotEmpty())
                    @foreach($formateurs as $formateur)
                    {{ $formateur->username }}<br>
                    @endforeach
                    @else
                    لم يحدد بعد
                    @endif
                </td>
                <td> @if($personnels->isNotEmpty())
                    @foreach($personnels as $personnel)
                    {{ $personnel->username }}<br>
                    @endforeach
                    @else
                    لم يحدد بعد
                    @endif
                </td>
                <td>{{$course->datedebut ?? 'لم يحدد بعد'}}</td>
                <td>{{$course->datefin ?? 'لم يحدد بعد'}}</td>
                <td>
                    @foreach($coursFiles as $file)
                    <a href="{{ url('courses/' . $file) }}" target="_blank">{{ $file }}</a><br>
                    @endforeach
                </td>
                <td>
                    @foreach($imagesFiles as $file)
                    <a href="{{ url('images/' . $file) }}" target="_blank">{{ $file }}</a><br>
                    @endforeach
                </td>
                <td>
                    {{ $personnels->where('genre', 'Homme')->count() ?? 0 }}
                </td>
                <td>
                    {{ $personnels->where('genre', 'Femme')->count() ?? 0 }}
                </td>
            </tr>
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
