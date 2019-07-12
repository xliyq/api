* [概述](header.md ':include')

@foreach($paths as $key=> $path)
* {{$key}}
@foreach($path as $item)
    * [{{$item['name']}}]({{$item['path']}} ':include')
@endforeach

@endforeach