@if ($array)
    <td>
        <label>
            <input name="{{ $column }}[]" type="checkbox" value="personal" {{ in_array('personal', $array) ? 'checked' : '' }}/>
            <span>Personal</span>
        </label>
    </td>
    <td>
        <label>
            <input name="{{ $column }}[]" type="checkbox" value="familiar" {{ in_array('familiar', $array) ? 'checked' : '' }}/>
            <span>Familiar</span>
        </label>
    </td>
@else
    <td>
        <label>
            <input name="{{ $column }}[]" type="checkbox" value="personal"/>
            <span>Personal</span>
        </label>
    </td>
    <td>
        <label>
            <input name="{{ $column }}[]" type="checkbox" value="familiar"/>
            <span>Familiar</span>
        </label>
    </td>
@endif