@foreach($devices as $device)
    <p>{{$device->name}} In? {{$device->is_in}} {{date('d/m/Y H:i:s', $device->updated_at)}}</p>
@endforeach