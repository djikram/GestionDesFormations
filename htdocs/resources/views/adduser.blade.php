@extends('layout')

@section('content')
<style>
/* Container with table and button */
.table-container {
    margin: 0 auto;
    width: 95%;
}

/* Flexbox for positioning the search input on the left and button on the right */
.add-user-and-search {
    display: flex;
    justify-content: space-between;
    /* Keeps elements on opposite sides */
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.add-user-button {
    display: flex;
    justify-content: flex-end;
}

/* Add some hover effect on the button */
.add-user-button .btn:hover {
    background-color: #0047b3;
    color: white;
}

/* Align table headings to the left */
th {
    text-align: left;
}

/* Center action buttons */
td button {
    margin-right: 5px;
}

/* Add styling to the form */
.add-user-form {
    margin-top: 40px;
    margin-bottom: 30px;
    margin-right: 100px;
    margin-left: 100px;
    max-width: 1200px;
    /* margin: 20px auto; */
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
    /* Align buttons to the left */
    gap: 10px;
    /* Add some space between the buttons */
    margin-top: 20px;
}
</style>

<!-- Container for Add User form -->
<div class="add-user-form">
    <h2>إضافة مستخدم</h2>
    <form method="POST" action="{{ route('createuser') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="الاسم" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"> البريدالإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">رقم الهاتف</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="cin" class="form-label">رقم البطاقة الوطنية</label>
            <input type="text" class="form-control" id="cin" name="cin" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">العمر</label>
            <input type="text" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">الجنس</label>
            <select class="form-select" id="genre" name="genre" required>
                <option value="" disabled selected hidden>يرجى الاختيار</option>
                <option value="Femme">أنثى</option>
                <option value="Homme">ذكر</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">الدور</label>
            <select class="form-select" id="role" name="role" required>
                <option value="" disabled selected hidden>يرجى الاختيار</option>
                <option value="Admin">المسؤول</option>
                <option value="Formateur">المدرب</option>
                <option value="Personnel">الموظف</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="departement" class="form-label">قسم</label>
            <select class="form-select" id="departement" name="departement" required>
                <option value="" disabled selected hidden>يرجى الاختيار</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">إضافة مستخدم</button>
            <button type="reset" class="btn btn-danger">إعادة ضبط</button>
        </div>
    </form>
</div>



<script>
$(document).ready(function() {
    $('#tableID').DataTable({
        "dom": 'f<"add-user-and-search"l>tip', // Custom layout for the search input and Add User button
    });
});
</script>
@endsection
