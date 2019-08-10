<table>
    <tbody>
    <tr>
        <th>Height:</th>
        <td colspan="2" style="padding: 0 5px;">
            {{ $record->height }} <i>m</i>
        </td>
    </tr>
    <tr>
        <th>Weight:</th>
        <td colspan="2" style="padding: 0 5px;">
            {{ $record->weight }} <i>Kg</i>
        </td>
    </tr>
    <tr>
        <th>Diabetes</th>
        @include('partials.components.record_checkbox', ['array' => json_decode($record->diabetes)])
    </tr>
    <tr>
        <th>Hypertension</th>
        @include('partials.components.record_checkbox', ['array' => json_decode($record->hypertension)])
    </tr>
    <tr>
        <th>Dyslipidemias</th>
        @include('partials.components.record_checkbox', ['array' => json_decode($record->dyslipidemias)])
    </tr>
    <tr>
        <th>Cancer</th>
        @include('partials.components.record_checkbox', ['array' => json_decode($record->cancer)])
    </tr>
    <tr>
        <th>Cardiovascular</th>
        @include('partials.components.record_checkbox', ['array' => json_decode($record->cardiovascular)])
    </tr>
    <tr>
        <th>Neurological</th>
        @include('partials.components.record_checkbox', ['array' => json_decode($record->neurological)])
    </tr>

    <tr>
        <th>Bruises</th>
        @include('partials.components.record_radio', ['value' => $record->bruises])
    </tr>
    <tr>
        <th>Fractures</th>
        @include('partials.components.record_radio', ['value' => $record->fractures])
    </tr>
    <tr>
        <th>Muscle Injuries</th>
        @include('partials.components.record_radio', ['value' => $record->muscle_injuries])
    </tr>

    <tr>
        <th>Alcohol</th>
        @include('partials.components.record_radio', ['value' => $record->tobacco])
    </tr>
    <tr>
        <th>Tobacco</th>
        @include('partials.components.record_radio', ['value' => $record->alcohol])
    </tr>
    @if ($record->other)
        <tr>
            <th>Other:</th>
            <td colspan="2" style="padding: 0 5px;">
                {{ $record->other }}
            </td>
        </tr>
    @endif
    </tbody>
</table>