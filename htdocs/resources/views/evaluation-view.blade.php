@extends('layout')
@section('content')

<style>
.course-info {
    display: flex;
    align-items: center;
    gap: 20px;
    /* Espace entre les éléments */
}

.course-link {
    font-size: 18px;
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
}

.course-link:hover {
    text-decoration: underline;
}

.personnel-list {
    font-size: 16px;
    color: #555;
}

.personnel-list span {
    display: inline-block;
    margin-left: 10px;
}




.table-container {
    margin: 0 auto;
    width: 95%;
}

.add-course-and-search {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-end;
    gap: 5px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.add-course-button {
    margin-bottom: 10px;
    /* Adds space below the button */
}

.search-container {
    margin-top: 5px;
    /* Optional: Adjusts spacing above the dropdown */
}




.title {
    text-align: right;
    padding-left: 300px;
    font-size: 24px;
    font-weight: bold;
}

th,
td {
    text-align: center;
    vertical-align: middle;
    padding: 10px;
}

.table thead {
    background-color: #f2f2f2;
}

.table th {
    font-weight: bold;
    text-align: center;
}
</style>

<div class="table-container">
    <div class="add-course-and-search">
        <div class="dataTables_filter" id="files_list_filter">
        </div>
        <div class="add-course-button">
            <a href="{{ route('addevaluation', $course->id) }}" class="btn btn-primary waves-effect waves-light">
                <i class="ti ti-plus"></i> إضافة تقييم
            </a>
        </div>
        <!-- <h2 class="title">تفاصيل التكوين :</h2> -->
        <a href="{{ url('courses') }}">التكوين: {{$course->name}}</a>
        <div class="search-container">
            <strong>الموظف:</strong>
            <select id="personnelFilter" class="form-control" style="display: inline-block; width: auto;">
                <option value="">-- اختر موظفاً --</option>
                @foreach($personnels as $personnel)
                <option value="{{ $personnel->username }}">{{ $personnel->username }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <!-- Table container -->
    <table id="evaluation_table" class="display">
        <thead>
            <tr>
                <th>الموضوع</th>
                <th>المهارة</th>
                <th>الموظف</th>
                <th>التقييم</th>
                <th>ملاحظات</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>

            @foreach($filteredEvaluations as $evaluation)
            <tr>
                <td>{{ $evaluation->competence->theme->nom }}</td>
                <td>{{ $evaluation->competence->nom }}</td>
                <td>{{ $evaluation->user->username }}</td> <!-- Display personnel -->
                <td>{{ $evaluation->note }}</td>
                <td>{{ $evaluation->commentaire }}</td>
                <td>
                    <div class="button-container">
                        <!-- edit -->
                        <a href="{{ url('editevaluation')}}/{{$evaluation->id}}/update">
                            <button class="btn rounded-pill btn-outline-info waves-effect" title="Edit">
                                <i class="ti ti-edit"></i>
                            </button>
                        </a>
                        <!-- delete -->
                        <!-- <a href="#" class="btn rounded-pill btn-outline-danger waves-effect" title="Delete">
                            <i class="ti ti-trash"></i>
                        </a> -->
                        <form action="{{ route('evaluation.destroy', $evaluation->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill btn-outline-danger waves-effect"
                                title="Delete" onclick="return confirm('هل أنت متأكد من حذف هذا التقييم؟')">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
    $('#evaluation_table').DataTable({
        "paging": true,
        "pageLength": 10,
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
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
    $('#personnelFilter').on('change', function() {
        const selectedPersonnel = $(this).val();
        const url = new URL(window.location.href);
        url.searchParams.set('personnel', selectedPersonnel); // Ajouter le filtre à l'URL
        window.location.href = url; // Recharger la page avec le paramètre de filtre
    });

});
</script>

@endsection
