@if ($errors->any())
<div class="mt-3">
    <ul>
        @foreach ($errors->all() as $error)
        <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif