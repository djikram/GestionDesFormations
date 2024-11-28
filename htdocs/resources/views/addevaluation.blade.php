@extends('layout')

@section('content')
<style>
.choices__inner {
    background-color: white !important;
    /* White background */
    border: 1px solid #ccc !important;
    /* Light gray border */
    border-radius: 4px !important;
    /* Rounded corners */
    padding: 8px !important;
    /* Padding for spacing */
    font-size: 16px !important;
    /* Font size */
    color: #333 !important;
    /* Text color */
}

.choices__inner:focus-within {
    border-color: #7d75fc !important;
    /* Purple border on focus */
    box-shadow: 0 0 5px rgba(108, 99, 255, 0.5) !important;
    /* Light purple shadow */
}

.choices__list--single {
    color: #333 !important;
    /* Text color */
    background-color: white !important;
    /* White background */
}

.choices__list--dropdown .choices__item--selectable {
    color: #333 !important;
    /* Text color */
    background-color: white !important;
    /* White background for dropdown items */
}

.choices__list--multiple .choices__item {
    background-color: #6040d4;
}

.choices__list--multiple .choices__item.is-highlighted {
    background-color: #7962c9;
    border: 1px solid #6040d4
}

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

.add-user-form {
    margin-top: 40px;
    margin-bottom: 30px;
    margin-right: 100px;
    margin-left: 100px;
    max-width: 1200px;
    background-color: #f9f9f9;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.add-user-form h2 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
}

.form-label {
    margin-top: 10px;
}

.button-group {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    margin-top: 20px;
}
</style>

<div class="add-user-form">
    <h2>إضافة تقييم</h2>
    <!-- Display validation errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('createevaluation', $courseId) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $courseId }}">
        <div class="mb-3">
            <label for="user_id" class="form-label">الموظف:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- اختر موظفاً --</option>
                @foreach($personnels as $personnel)
                <option value="{{ $personnel->id }}">{{ $personnel->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="theme_id" class="form-label">الموضوع:</label>
            <div class="input-group">
                <input type="text" name="theme_name" id="theme_name" placeholder="اكتب موضوعاً" class="form-control">
                <select name="theme_id" id="theme_id" class="form-control" >
                    <option value="">-- اختر موضوعاً --</option>
                    @foreach($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="competence_id" class="form-label">المهارة:</label>
            <div class="input-group">
                <input type="text" name="competence_name" id="competence_id" placeholder="أو أدخل مهارة جديدة" class="form-control">
                <select name="competence_id" id="competence_id" class="form-control" >
                    <option value="">-- اختر مهارة --</option>
                    @foreach($competences as $competence)
                    <option value="{{ $competence->id }}">{{ $competence->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="note"class="form-label">التقييم:</label>
            <input type="number" name="note" id="note" class="form-control" min="0" max="20" required>
        </div>
        <div class="mb-3">
            <label for="commentaire"class="form-label">ملاحظات:</label>
            <textarea name="commentaire" id="commentaire" class="form-control"></textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">إضافة تقييم</button>
            <button type="reset" class="btn btn-danger">إعادة ضبط</button>
        </div>
    </form>
</div>



<script>
$(document).ready(function() {
    $('#tableID').DataTable({
        "dom": 'f<"add-course-and-search"l>tip', // Custom layout for the search input and Add User button
    });

});
</script>
@endsection
