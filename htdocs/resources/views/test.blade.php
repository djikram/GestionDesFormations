@extends('layout')
@section('content')
<!-- <style>
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
</style> -->
  <!-- <div class="table-container"> -->
    <!-- <div class="add-user-and-search">
      <div class="dataTables_filter" id="files_list_filter">
        //Search box here
      </div>

      //Add User Button aligned to the right
       <div class="add-user-button">
        <a href="adduser" class="btn btn-primary waves-effect waves-light">
            <i class="ti ti-plus"></i> إضافة مستخدم
        </a>
      </div>
    </div> -->
    <!-- <table id="files_list" class="display">
        <thead>
            <tr>
                <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>رقم البطاقة الوطنية</th>
                <th>العمر</th>
                <th>الجنس</th>
                <th>دور المستخدم</th>
                <th>إجراء</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>نزار المرزوقي</td>
                <td>مصمم واب</td>
                <td>456</td>
                <td>11/09/2019</td>
                <td>ادارة الانتاج</td>
                <td>htp://www.devinshi.com</td>
                <td>htp://www.devinshi.com</td>
                <td>
                    <button class="btn btn-sm btn-download btn-info">
                        <i class="fas fa-arrow-circle-down"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table> -->
    <!-- </div> -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
<!-- <script>
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
</script> -->

    <div class="container">
        <h1>Évaluation pour la formation : {{ $course->name }}</h1>

        <h2>Personnels :</h2>
        <ul>
            @foreach($course->personnels as $personnel)
                <li>{{ $personnel->username }}</li>
            @endforeach
        </ul>

        <h2>Thèmes et compétences :</h2>
        @foreach($course->themes as $theme)
            <h3>Thème : {{ $theme->nom }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Compétence</th>
                        <th>Personnel</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($theme->competence as $competence)
                        @foreach($competence->evaluation as $evaluation)
                            <tr>
                                <td>{{ $competence->nom }}</td>
                                <td>{{ $evaluation->user->username }}</td>
                                <td>{{ $evaluation->note }}</td>
                                <td>{{ $evaluation->commentaire }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>



@endsection
