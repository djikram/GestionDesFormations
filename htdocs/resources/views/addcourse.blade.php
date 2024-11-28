@extends('layout')

@section('content')
<style>
.choices__inner {
    background-color: white !important; /* White background */
    border: 1px solid #ccc !important; /* Light gray border */
    border-radius: 4px !important; /* Rounded corners */
    padding: 8px !important; /* Padding for spacing */
    font-size: 16px !important; /* Font size */
    color: #333 !important; /* Text color */
}

.choices__inner:focus-within {
    border-color: #7d75fc !important; /* Purple border on focus */
    box-shadow: 0 0 5px rgba(108, 99, 255, 0.5) !important; /* Light purple shadow */
}

.choices__list--single {
    color: #333 !important; /* Text color */
    background-color: white !important; /* White background */
}

.choices__list--dropdown .choices__item--selectable {
    color: #333 !important; /* Text color */
    background-color: white !important; /* White background for dropdown items */
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


<!-- Container for Add User form -->
<div class="add-user-form">
    <h2>إضافة دورة</h2>

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
    <form method="POST" action="{{ route('createcourse') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">محاور التكوين
            </label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="datedebut" class="form-label">تاريخ البدء </label>
            <input type="date" class="form-control" id="datedebut" name="datedebut"
                style="direction: rtl; text-align: right;">
        </div>
        <div class="mb-3">
            <label for="datefin" class="form-label">تاريخ الانتهاء </label>
            <input type="date" class="form-control" id="datefin" name="datefin"
                style="direction: rtl; text-align: right;">
        </div>
        <div class="mb-3">
            <label for="modeformation" class="form-label"> طبيعة التكوين </label>
            <select class="form-select" id="modeformation" name="modeformation"
                style="direction: rtl; text-align: right;" required>
                <option value="" disabled selected hidden>يرجى الاختيار</option>
                <option value="حضوري">حضوري</option>
                <option value=" عن بعد">عن بعد</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="groupecible" class="form-label"> الفئة المستهدفة </label>
            <textarea type="text" class="form-control" id="groupecible" name="groupecible" required></textarea>
        </div>
        <div class="mb-3">
            <label for="formateur" class="form-label">المدربين</label>
            <select id="formateur" name="formateur[]" multiple style="direction: rtl; text-align: right; background-color: blue;">
                @foreach ($formateurs as $formateur)
                <option value="{{ $formateur->id }}">{{ $formateur->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="personnel" class="form-label">المستفدين</label>
            <select id="personnel" name="personnel[]" multiple style="direction: rtl; text-align: right;">
                @foreach ($personnels as $personnel)
                <option value="{{ $personnel->id }}">{{ $personnel->username }}</option>
                @endforeach
            </select>
        </div>
        <!-- nbrbenefi = personelles -->
        <div class="mb-3">
            <label for="nbrJours" class="form-label"> عدد أيام التكوين </label>
            <input type="int" class="form-control" id="nbrJours" name="nbrJours"
                placeholder="إدخال يدوي إذا كانت التواريخ غير معروفة" style="direction: rtl; text-align: right;"
                required>
        </div>
        <div class="mb-3">
            <label for="nbrcours" class="form-label"> عدد الدورات </label>
            <input type="int" class="form-control" id="nbrcours" name="nbrcours"
                placeholder="إدخال يدوي إذا كانت توجد دورات  " style="direction: rtl; text-align: right;" required>
        </div>
        <div class="mb-3">
            <label for="organisateur" class="form-label"> الجهة المنظمة </label>
            <textarea type="text" class="form-control" id="organisateur" value="لم يحدد بعد" name="organisateur" placeholder="لم يحدد بعد" required>

            </textarea>
        </div>
        <div class="mb-3">
            <label for="cours" class="form-label">العروض</label>
            <input type="file" class="form-control" id="cours" name="cours[]" accept="application/pdf" multiple
                required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">الصور</label>
            <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple required>
        </div>
        <div class="button-group">
            <button type="submit" class="btn btn-primary">إضافة دورة</button>
            <button type="reset" class="btn btn-danger">إعادة ضبط</button>
        </div>
    </form>
</div>



<script>
$(document).ready(function() {
    $('#tableID').DataTable({
        "dom": 'f<"add-course-and-search"l>tip', // Custom layout for the search input and Add User button
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
