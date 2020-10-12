<h1>Uued ajad</h1>
@foreach ($times as $time)
    <div>{{ $time->format('d.m.Y H:i') }}</div>
@endforeach

<h2><a href="https://eteenindus.mnt.ee">Broneeri aeg</a></h2>
