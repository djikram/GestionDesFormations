@extends('layout')

@section('content')
<style>

.file-list li {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 10px;
}

.file-list a {
    margin-left: 5px;
}

.file-list img {
    width: 100px;
    height: auto;
    margin-left: 10px;
}



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


.table-container {
    margin: 0 auto;
    width: 95%;
}

.edit-user-and-search {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.edit-user-button {
    display: flex;
    justify-content: flex-end;
}

.edit-user-button .btn:hover {
    background-color: #0047b3;
    color: white;
}

th {
    text-align: left;
}

td button {
    margin-right: 5px;
}

.edit-user-form {
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

.edit-user-form h2 {
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

<!-- Container for Add User form -->
<div class="edit-user-form">
    <h2>تعديل دورة</h2>
    <form method="POST" action="{{ url('editcourse')}}" enctype="multipart/form-data" data-toggle="validator">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">محاور التكوين</label>
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="text" class="form-control" id="name" name="name" value="{{ $course->name}}" required>
        </div>
        <div class="mb-3">
            <label for="datedebut" class="form-label">تاريخ البدء </label>
            <input type="date" class="form-control" id="datedebut" name="datedebut" value="{{ $course->datedebut}}"
                style="direction: rtl; text-align: right;">
        </div>
        <div class="mb-3">
            <label for="datefin" class="form-label">تاريخ الانتهاء </label>
            <input type="date" class="form-control" id="datefin" name="datefin" value="{{ $course->datefin}}"
                style="direction: rtl; text-align: right;">
        </div>
        <div class="mb-3">
            <label for="modeformation" class="form-label"> طبيعة التكوين </label>
            <select class="form-select" id="modeformation" name="modeformation"
                style="direction: rtl; text-align: right;" required>
                <option value="" disabled @if(!isset($course) || !$course->modeformation) selected @endif hidden>يرجى
                    الاختيار</option>
                <option value="حضوري" @if(isset($course) && $course->modeformation == 'حضوري') selected @endif>حضوري
                </option>
                <option value="عن بعد" @if(isset($course) && $course->modeformation == 'عن بعد') selected @endif>عن بعد
                </option>
                <option value="لم يحدد بعد" @if(isset($course) && $course->modeformation == 'لم يحدد بعد') selected
                    @endif>لم يحدد بعد</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="groupecible" class="form-label"> الفئة المستهدفة </label>
            <textarea type="text" class="form-control" id="groupecible" name="groupecible"
                required>{{ $course->groupecible }}</textarea>
        </div>
        <div class="mb-3">
            <label for="organisateur" class="form-label">الجهة المنظمة </label>
            <textarea type="text" class="form-control" id="organisateur" name="organisateur" placeholder="لم يحدد بعد"
                required>{{ $course->organisateur == 0 ? 'لم يحدد بعد' : $course->organisateur }}</textarea>
        </div>
        <div class="mb-3">
            <label for="nbrJours" class="form-label"> عدد أيام التكوين </label>
            <input type="int" class="form-control" id="nbrJours" name="nbrJours"
                placeholder="إدخال يدوي إذا كانت التواريخ غير معروفة" value="{{ $course->nbrJours}}"
                style="direction: rtl; text-align: right;">
        </div>
        <div class="mb-3">
            <label for="nbrcours" class="form-label"> عدد الدورات </label>
            <input type="int" class="form-control" id="nbrcours" name="nbrcours"
                placeholder="إدخال يدوي إذا كانت توجد دورات  " value="{{ $course->nbrcours}}"
                style="direction: rtl; text-align: right;">
        </div>
        <div class="mb-3">
            <label for="formateur" class="form-label">المدربين</label>
            <select id="formateur" name="formateur[]" multiple class="form-control"
                style="direction: rtl; text-align: right;">
                @foreach ($formateurs as $formateur)
                <option value="{{ $formateur->id }}"
                    {{ isset($selectedFormateurs) && in_array($formateur->id, $selectedFormateurs) ? 'selected' : '' }}>
                    {{ $formateur->username }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="personnel" class="form-label">المستفدين</label>
            <select id="personnel" name="personnel[]" multiple class="form-control"
                style="direction: rtl; text-align: right;">
                @foreach ($personnels as $personnel)
                <option value="{{ $personnel->id }}"
                    {{ isset($selectedPersonnels) && in_array($personnel->id, $selectedPersonnels) ? 'selected' : '' }}>
                    {{ $personnel->username }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cours" class="form-label">العروض</label>
            <div>
                @if(isset($coursFiles) && count($coursFiles) > 0)
                <ul class="file-list">
                    @foreach($coursFiles as $file)
                    <li>
                    <input type="checkbox" name="delete_files[]" value="{{ $file->id }}"> Supprimer
                        <a href="{{ asset('courses/'.$file->name) }}" target="_blank" style="direction: ltr; text-align: right;">{{ $file->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @else
                <p>Aucun fichier existant.</p>
                @endif
            </div>
            <input type="file" class="form-control" id="cours" name="cours[]" accept="application/pdf" multiple>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">الصور</label>
            <div>
                @if(isset($imagesFiles) && count($imagesFiles) > 0)
                <ul class="file-list">
                    @foreach($imagesFiles as $image)
                    <li>
                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> Supprimer
                        <a href="{{ asset('images/'.$image->name) }}" target="_blank">
                            <img src="{{ asset('images/'.$image->name) }}" alt="{{ $image->name }}" style="width: 100px; height: auto;">
                        </a>

                    </li>
                    @endforeach
                </ul>
                @else
                <p>Aucune image existante.</p>
                @endif
            </div>
            <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>
        </div>
        <div class="button-group">
            <button type="submit" class="btn btn-primary">تعديل دورة</button>
            <button type="reset" class="btn btn-danger">إعادة ضبط</button>
        </div>
    </form>
</div>

<script>
function confirmDelete(fileName) {
    if (confirm('Are you sure you want to delete ' + fileName + '?')) {
        // Handle the delete logic here, maybe via an AJAX request
    }
}
$(document).ready(function() {
    $('#tableID').DataTable({
        "dom": 'f<"edit-course-and-search"l>tip', // Custom layout for the search input and Add User button
    });
    const formateurSelect = new Choices('#formateur', {
        removeItemButton: true,
        placeholderValue: "يرجى الاختيار ", // Placeholder text
        searchPlaceholderValue: 'ابحث...', // Search box placeholder
    });
    const personnelSelect = new Choices('#personnel', {
        removeItemButton: true,
        placeholderValue: "يرجى الاختيار ", // Placeholder text
        searchPlaceholderValue: 'ابحث...', // Search box placeholder
    });

});
</script>

@endsection
