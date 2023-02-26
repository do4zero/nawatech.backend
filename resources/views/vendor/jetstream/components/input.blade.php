@props(['disabled' => false]) <input {{ $disabled ? "disabled" : "" }} {!!
$attributes->merge(['class' => 'border-gray-300 focus:border-0 rounded-full pl-5
shadow-sm']) !!}>
