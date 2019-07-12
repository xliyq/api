# {!! $name !!}

@foreach($group as $api)

@if(isset($api['deprecated']))
## ~~{!! $api['title'] !!}~~

> {!! $api['description'] !!}
> 废弃于： {!! $api['deprecated']['content'] !!}
@else
## {!! $api['title'] !!}

> {!! $api['description'] !!}
@endif

`{!! $api['type'] !!}`
```url
{!! $api['url'] !!}
```

@if(isset($api['header']))
### headers
| key        | Value                         | 描述                                                             |
|---------------|-------------------------------------|---------------------------------------------------------|
@foreach($api['header']['fields']['Header'] as $header)
|{!! $header['field'] !!}|`{!! $header['type'] !!}`{!! isset($header['defaultValue']) && $header['defaultValue'] !!}|{!! $header['description'] !!}|
@endforeach
@endif

@if(isset($api['parameter']) )
### 参数
| 参数名        | 类型                         | 可选                         |描述                                                             |
|---------------|------------------------------|------------------------------|------------------------------------|
@foreach ($api['parameter']['fields']['Parameter'] as $param)
|`{!! $param['field'] !!}`|`{!! $param['type'] !!}`|`{!! $param['optional'] ? 'true' : 'false' !!}`|{!! $param['description'] !!}|
@endforeach
@endif

@if(isset($api['success']))
### 返回值
@if(isset($api['success']['fields']['Success 200']))
| 参数名        | 类型                         | 可选                         |描述                                |
|---------------|------------------------------|------------------------------|------------------------------------|
@foreach($api['success']['fields']['Success 200'] as $field)
|`{!! $field['field'] !!}`|`{!! $field['type'] !!}`|`{!! $field['optional'] ? 'true' : 'false' !!}`|{!! strip_tags($field['description']) !!}|
@endforeach
@endif

@if(isset($api['success']['examples']))
@foreach ($api['success']['examples'] as $item)
#### {!! $item['title'] !!}
```{!! $item['type'] !!}
{!! $item['content'] !!}
```
@endforeach
@endif
@endif


### 测试
<div class="test">
        <form action="{{$baseUrl}}/{{$api['url']}}" method="{{$api['type']}}" enctype="multipart/form-data">
            @if(isset($api['parameter']) )
                @foreach($api['parameter']['fields']['Parameter'] as $param)
                    <div>
                        <label>
                            {{$param['field']}}
                        </label>
                        <input type="{{$param['type'] === 'file' ? 'file':'text'}}"
                               name="{{$param['field']}}" placeholder="{!! strip_tags($param['description']) !!}">
                    </div>
                @endforeach
            @endif
            <div>
                <button id="submit" type="button">测试</button>
            </div>
        </form>
        <div class="response">
            <h3>Request URL</h3>
            <pre v-pre data-lang="url" class="response-url">
                <code class='language-url'></code>
            </pre>
            <h3>Request Headers</h3>
            <pre class="response-headers"></pre>
            <h3>Response Body</h3>
            <pre v-pre data-lang="json" class="response-json">
        <code class='language-json'></code>
        </pre>
            <h3>Response Code</h3>
            <pre class="response-code"></pre>
            <h3>Response Header</h3>
            <pre v-pre data-lang="text" class="response-res-headers">
                <code class='language-text'></code>
            </pre>
        </div>
    </div>

@endforeach