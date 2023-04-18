@props([
    'url',
    'color' => 'blue',
    'align' => 'center',
])
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td class="content text-{{ $align }}">
<table cellspacing="0" cellpadding="0">
<tr>
<td align="{{ $align }}">
<table cellpadding="0" cellspacing="0" border="0" class="bg-{{ $color }} rounded w-auto">
<tr>
<td align="{{ $align }}" valign="top" class="lh-1">
<a href="{{ $url }}" class="btn bg-{{ $color }} border-{{ $color }}">
<span class="btn-span">{{ $slot }}</span>
</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>