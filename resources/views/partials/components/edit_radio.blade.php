<td>
    <label>
        <input name="{{ $column }}" type="radio" value="1" {{ $value == 1 ? 'checked' : '' }}/>
        <span>Yes</span>
    </label>
</td>
<td>
    <label>
        <input name="{{ $column }}" type="radio" value="0" {{ $value == 0 ? 'checked' : '' }}/>
        <span>No</span>
    </label>
</td>