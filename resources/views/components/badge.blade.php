@props(['textColor', 'bgColor'])
@php
$textColor = match($textColor){
'gray' => 'text-gray-800',
'blue' => 'text-blue-800',
'red' => 'text-red-800',
'yellow' => 'text-yellow-800',
default => 'text-gray-800'
};
$bgColor = match($bgColor){
'gray' => 'bg-gray-100',
'blue' => 'text-blue-100',
'red' => 'text-red-100',
'yellow' => 'text-yellow-100',
default => 'text-gray-100'
};
@endphp
<button {{attributes}} class="{{$textColor}} {{$bgColor}} rounded-xl px-3 py-1 text-base">
    {{$slot}}</button>