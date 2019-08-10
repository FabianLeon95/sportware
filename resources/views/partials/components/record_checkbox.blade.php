@if ($array)
    <td>
        @for ($i = 0; $i < count($array); $i++)
            {{ ucfirst($array[$i]) }}{{ ($i == (count($array)-1)) ? '':', ' }}
        @endfor
    </td>
@else
    <td class="red-text">
        <i class="material-icons">
            close
        </i>
    </td>
@endif