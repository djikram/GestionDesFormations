@extends('layout')
@section('content')
<style>
th:last-child,
td:last-child {
    text-align: center;
    width: 100px;
    /* Ajustez la largeur selon vos besoins */
}

.dropdown .dropdown-toggle {
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 4px;
}

.dropdown-menu {
    min-width: 120px;
    /* Réduit la largeur du menu */
    font-size: 14px;
    /* Diminue la taille du texte */
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 5px;
    /* Espace entre l'icône et le texte */
    padding: 5px 10px;
    /* Réduit l'espacement des options */
}







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

.add-course-button {
    display: flex;
    justify-content: flex-end;
}

.add-course-button .btn:hover {
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
    margin-right: 5px;
    /* Space between the buttons */
}

.btn-view {
    border-color: #4CAF50;
    /* Green border for the View button */
    color: #4CAF50;
    /* Green icon color */
}


</style>

<div class="table-container">
    <div class="add-course-and-search">
        <div class="dataTables_filter" id="files_list_filter">

        </div>
        <span>عدد التكوينات الحضورية: <span class="badge badge-info">{{ $coursesCount }}</span></span>  <!-- Count for حضوري -->
    <span>عدد التكوينات عن بعد: <span class="badge badge-info">{{ $distanceCount }}</span></span>  <!-- Count for عن بعد -->
        <div class="add-course-button">
            <a href="addcourse" class="btn btn-primary waves-effect waves-light">
                <i class="ti ti-plus"></i> إضافة دورة
            </a>
        </div>
    </div>

    <!-- Table container -->
    <table id="files_list" class="display">
        <thead>
            <tr>
                <th>محاور التكوين</th>
                <th>طبيعة التكوين</th>
                <th>الفئة المستهدفة</th>
                <th>عدد المستفيدين</th>
                <th>عدد أيام التكوين</th>
                <th>عدد الدورات </th>
                <th>الجهة المنظمة</th>
                <th>الإجراء</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{$course->name}}</td>
                <td>{{$course->modeformation}}</td>
                <td>{{$course->groupecible}}</td>
                <td>{{ $course->personnelsCount() ?? 'لم يحدد بعد' }}</td>

                <td>{{$course->nbrJours ?? 'لم يحدد بعد'}}</td>
                <td>{{$course->nbrcours ?? 'لم يحدد بعد'}}</td>
                <td>{{$course->organisateur == 0 ? 'لم يحدد بعد' : $course->organisateur}}</td>

                <td>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                            style="color: #fff; background-color: #7367f0; border-color: #7367f0;"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu">
                            <div class="button-container">
                                <!-- view-->
                                <a href="{{ route('course.show', $course->id) }}">
                                    <button class="btn rounded-pill btn-outline-warning waves-effect dropdown-item"
                                        title="View">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </a>
                                <!-- edit -->
                                <a href="{{ url('editcourse')}}/{{$course->id}}/update">
                                    <button class="btn rounded-pill btn-outline-info waves-effect dropdown-item"
                                        title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                </a>
                                <!-- delete -->
                                <form id="delete-course-{{ $course->id }}"
                                    action="{{ route('course.destroy', $course->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn rounded-pill btn-outline-danger waves-effect dropdown-item"
                                        title="Delete"
                                        onclick="return confirm('هل أنت متأكد أنك تريد حذف هذه الدورة؟')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                                <!-- evaluation-->
                                @if($course->personnels->isNotEmpty())
                                <a
                                    href="{{ route('evaluation.show', ['courseId' => $course->id, 'personnel' => $course->personnels->first()->id]) }}">
                                    <button class="btn rounded-pill btn-outline-success waves-effect dropdown-item"
                                        title="View">
                                        <i class="fas fa-star" style="color: gold;"></i>
                                    </button>
                                </a>
                                @endif
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



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
<!-- <script>
$(document).ready(function() {
    $('#tableID').DataTable({
        "dom": 'f<"add-course-and-search"l>tip', // Custom layout for the search input and Add course button
    });
});
</script> -->
@endsection
