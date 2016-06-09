@if (count($errors) > 0)
    <!-- Список ошибок формы -->
    <div class="alert alert-danger">
        <strong>Обнаружены следующие ошибки:</strong>
        <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif