@props(['messages','type','animation','textAlign'])

@if ($type == 'success')
    <div class="badge-message-success @if(isset($animation)) {{$animation}} @endif" style="@if(isset($textAlign)) text-align:{{$textAlign}} @endif">
        {{ $messages }}
    </div>
@elseif($type == 'danger')
    <div class="badge-message-failed @if(isset($animation)) {{$animation}} @endif" style="@if(isset($textAlign)) text-align:{{$textAlign}} @endif">
        {{ $messages }}
    </div>
@endif
