@php
    var_dump($errors)
@endphp
<form action="{{ route("test") }}" method="post">
    @csrf
    <button type="submit">ok</button>
</form>