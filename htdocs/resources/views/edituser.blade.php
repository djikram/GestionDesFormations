@extends('layout')

@section('content')
<style>
/* Container with table and button */
.table-container {
    margin: 0 auto;
    width: 95%;
}

/* Flexbox for positioning the search input on the left and button on the right */
.edit-user-and-search {
    display: flex;
    justify-content: space-between;
    /* Keeps elements on opposite sides */
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.edit-user-button {
    display: flex;
    justify-content: flex-end;
}

/* Add some hover effect on the button */
.edit-user-button .btn:hover {
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
.edit-user-form {
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
    /* Align buttons to the left */
    gap: 10px;
    /* Add some space between the buttons */
    margin-top: 20px;
}
</style>

<!-- Container for Edit User form -->
<div class="edit-user-form">
    <h2>تعديل المستخدمين</h2>
    <form action="{{ url('edituser')}}" method="POST" data-toggle="validator">
        @csrf
        @php
        $user = DB::table('users')->where('id',$id )->first();
        @endphp
        <div class="mb-3">

            <label for="username" class="form-label">الاسم</label>
            <input type="hidden" name="id" value="{{  $user->id }}">

            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username}}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">رقم الهاتف</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone}}" required>
        </div>
        <div class="mb-3">
            <label for="cin" class="form-label">رقم الهوية</label>
            <input type="text" class="form-control" id="cin" name="cin" value="{{ $user->cin}}" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">العمر</label>
            <input type="text" class="form-control" id="age" name="age" value="{{ $user->age}}" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">الجنس</label>
            <select class="form-select" id="genre" name="genre" required>
                <option value="" disabled selected hidden>يرجى الاختيار</option>
                <option value="Femme" @if($user->genre === 'Femme') selected
                    @endif>أنثى</option>
                <option value="Homme" @if($user->genre === 'Homme') selected
                    @endif>ذكر</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ $user->password}}"
                required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="" disabled selected hidden>يرجى الاختيار</option>
                <option value="Admin" @if($user->role === 'Admin') selected
                    @endif>المسؤول</option>
                <option value="Formateur" @if($user->role === 'Formateur') selected
                    @endif>المدرب</option>
                <option value="Personnel" @if($user->role === 'Personnel') selected
                    @endif>الموظف</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="departement" class="form-label">قسم</label>
            <select class="form-select" id="departement" name="departement" required>
                <option value="" disabled hidden>يرجى الاختيار</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}" @if($user->departement == $department->id) selected @endif>
                    {{ $department->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- <div class="form-check">
            <input class="form-check-input" type="checkbox" id="notifyUserByEmail" name="notify_user" checked>
            <label class="form-check-label" for="notifyUserByEmail">
                Notify User by Email
            </label>
        </div> -->
        <div class="button-group">
            <button type="submit" class="btn btn-primary">تعديل المستخدمين
            </button>
            <button type="reset" class="btn btn-danger">إعادة ضبط</button>
        </div>
    </form>
</div>



<script>
$(document).ready(function() {
    $('#tableID').DataTable({
        "dom": 'f<"edit-user-and-search"l>tip', // Custom layout for the search input and Edit User button
    });
});
</script>
@endsection
