@extends('layout')

@section('content')

<style>

/* input:disabled, select:disabled {
    background-color: #e9ecef;
    cursor: not-allowed;
} */
/* Override the size of the Choices.js select dropdown */
.choices__inner {
    min-width: 100%; /* Ensure it stretches to fit */
    font-size: 16px !important;
    padding: 8px !important;
}

/* Adjust the width and size of the select input */
.choices__input {
    width: 100%;
}

/* If necessary, you can adjust the container around the select too */
.choices {
    display: block;
    width: 100%;
}


.choices__list--single .choices__item {
    display: block;
    font-size: 0.9375rem;
    font-weight: 100;
    line-height: 0.5;
    width: 100%;
    color: #6f6b7d;
}

.choices::after {
    content: none;
    display: none;
}

.choices::after {
    content: "";
    height: 0;
    width: 0;
    border-style: solid;
    border-color: #333 transparent transparent;
    border-width: 5px;
    position: relative;
    left: 10px;
    /* Move to left */
    top: 50%;
    /* Align it vertically */
    margin-top: -2.5px;
}

select {
    padding: 8px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    background-color: #fff;
    color: #333;
    width: 100%;
}

select:focus {
    border-color: #7d75fc;
    box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
}

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
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    padding: 8px !important;
    font-size: 16px !important;
    color: #333 !important;
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

.button-group {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    margin-top: 20px;
}

.form-label {
    margin-top: 10px;
}

th {
    text-align: left;

}

td button {
    margin-right: 5px;
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

.table-container {
    margin: 0 auto;
    width: 95%;
}
</style>

<div class="edit-user-form">
    <h2>تعديل تقييم</h2>
    <form method="POST" action="{{ url('editevaluation/' . $evaluation->id) }}" enctype="multipart/form-data"
        data-toggle="validator">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">الموظف</label>
            <select name="user_id" id="user_id" class="form-select">
                @foreach ($personnels as $personnel)
                <option value="{{ $personnel->id }}" {{ $evaluation->idUser == $personnel->id ? 'selected' : '' }}>
                    {{ $personnel->username }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="theme_id" class="form-label">الموضوع</label>
            <span style="font-size: 12px; color: gray; margin-left: 5px;">(يمكنك التعديل باختيار أو الكتابة)</span>
            <div class="input-group"style="display: flex; gap: 10px;">
                <input type="text" name="theme_name" id="theme_name" class="form-control" placeholder="أدخل موضوع جديد"
                    value="{{ old('theme_name', $evaluation->competence->theme->nom ?? '') }}"
                    oninput="toggleSelect('theme_name', 'theme_id')"style="flex: 1; box-sizing: border-box;">

                    <select name="theme_id" id="theme_id" class="form-select" onchange="toggleInput('theme_id', 'theme_name')" style="flex: 1; box-sizing: border-box;">
                    <!-- <option value="">-- اختر موضوعاً --</option> -->
                    @foreach ($themes as $theme)
                    <option value="{{ $theme->id }}"
                        {{ $evaluation->competence->idTheme == $theme->id ? 'selected' : '' }}>
                        {{ $theme->nom }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="competence_id" class="form-label">المهارة</label>
            <span style="font-size: 12px; color: gray; margin-left: 5px;">(يمكنك التعديل باختيار أو الكتابة)</span>
            <div class="input-group"style="display: flex; gap: 10px;">
                <input type="text" name="competence_name" id="competence_name" class="form-control" placeholder="أدخل مهارة جديدة"
                    value="{{ old('competence_name', $evaluation->competence->nom ?? '') }}"
                    oninput="toggleSelect('competence_name', 'competence_id')" style="flex: 1; box-sizing: border-box;"
                >
                <select name="competence_id" id="competence_id" class="form-select"style="flex: 1; box-sizing: border-box;" onchange="toggleInput('competence_id', 'competence_name')" >
                    @foreach ($competences as $competence)
                    <option value="{{ $competence->id }}"
                        {{ $evaluation->idCompetence == $competence->id ? 'selected' : '' }}>
                        {{ $competence->nom }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">التقييم</label>
            <input type="number" class="form-control" id="note" name="note" min="0" max="20"
                value="{{ $evaluation->note }}" required>
        </div>

        <div class="mb-3">
            <label for="commentaire" class="form-label">ملاحظات</label>
            <textarea class="form-control" id="commentaire" name="commentaire">{{ $evaluation->commentaire }}</textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">تعديل تقييم</button>
            <button type="reset" class="btn btn-danger">إعادة ضبط</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
document.getElementById('theme_id').addEventListener('change', function() {
    const themeId = this.value;

    // Fetch competences for the selected theme via AJAX
    fetch(`/get-competences/${themeId}`)
        .then(response => response.json())
        .then(data => {
            const competenceSelect = document.getElementById('competence_id');
            competenceSelect.innerHTML = '';

            data.forEach(competence => {
                const option = document.createElement('option');
                option.value = competence.id;
                option.textContent = competence.nom;
                competenceSelect.appendChild(option);
            });
        });

});
function toggleInputVisibility() {
        const selectField = document.getElementById('competence_id');
        const inputField = document.getElementById('competence_input');

        if (selectField.value === '') {
            // If no selection, show the input field to allow manual entry
            selectField.hidden = true;
            inputField.hidden = false;
        } else {
            // If an option is selected, show the select dropdown and hide the input
            selectField.hidden = false;
            inputField.hidden = true;
        }
    }
document.addEventListener('DOMContentLoaded', function() {
    toggleInputVisibility();

    new Choices('#user_id', {
        searchPlaceholderValue: 'ابحث...',
        placeholder: true
    });

    new Choices('#theme_id', {
        // removeItemButton: true,
        searchPlaceholderValue: 'ابحث...',
        placeholder: true
    });

    new Choices('#competence_id', {
        // removeItemButton: true,
        searchPlaceholderValue: 'ابحث...',
        placeholder: true
    });

});
// Focus on the input field when it's clicked so the user can type
    function showInput() {
        const selectField = document.getElementById('competence_id');
        const inputField = document.getElementById('competence_input');

        // Hide the select dropdown and show the input field
        selectField.hidden = true;
        inputField.hidden = false;
    }
    function toggleSelect(inputId, selectId) {
    const inputField = document.getElementById(inputId);
    const selectField = document.getElementById(selectId);

    if (inputField.value.trim()) {
        selectField.disabled = true;
    } else {
        selectField.disabled = false;
    }
}

function toggleInput(selectId, inputId) {
    const selectField = document.getElementById(selectId);
    const inputField = document.getElementById(inputId);

    if (selectField.value) {
        inputField.disabled = true;
    } else {
        inputField.disabled = false;
    }
}


</script>

@endsection
