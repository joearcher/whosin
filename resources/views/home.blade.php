@foreach($devices as $device)
    <p>{{$device->name}} In? {{$device->is_in ? 'Yes' : 'No'}} {{$device->updated_at->format('d/m/Y H:i:s')}}</p>
@endforeach