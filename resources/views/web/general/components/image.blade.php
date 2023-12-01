{{-- @include('xnk.components.image', [
    'src' => $config_general['logo_header']??'',
    'width' => '150px',
    'height' => '40px',
    'lazy'   => true,
    'title'  => ''
]) --}}
@if (isset($lazy) && $lazy == false)
    <img
        src="{{($src ?? '')}}"
        alt="{{$alt ?? getAlt($src??'')}}"
        @if (isset($title) && !empty($title))
            title="{{$title ?? ''}}"
        @endif
        @if (isset($width) && !empty($width))
            width="{{$width ?? ''}}"
        @endif
        @if (isset($height) && !empty($height))
            height="{{$height ?? ''}}"
        @endif
        @if (isset($function) && !empty($function))
            onclick="{{$function ?? ''}}"
        @endif
    >
@else
    <img
        loading="lazy"
        src="{{($src ?? '')}}"
        alt="{{$alt ?? getAlt($src??'')}}"
        @if (isset($title) && !empty($title))
            title="{{$title ?? ''}}"
        @endif
        @if (isset($width) && !empty($width))
            width="{{$width ?? ''}}"
        @endif
        @if (isset($height) && !empty($height))
            height="{{$height ?? ''}}"
        @endif
        @if (isset($function) && !empty($function))
            onclick="{{$function ?? ''}}"
        @endif
    >
@endif
