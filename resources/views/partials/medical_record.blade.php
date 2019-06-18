<table>
    <thead>
    <tr>
        <th>Condicion</th>
        <th>Valor</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>Diabetes</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->diabetes) }}</td>
    </tr>
    <tr>
        <td>Hipertension</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->hypertension) }}</td>
    </tr>

    <tr>
        <td>Dislipidemias</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->dyslipidemia) }}</td>
    </tr>
    <tr>
        <td>Cancer</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->cancer) }}</td>
    </tr>
    <tr>
        <td>Cardiovasculares</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->cardiovascular) }}</td>
    </tr>
    <tr>
        <td>Neurologicas</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->neurological) }}</td>
    </tr>
    <tr>
        <td>Contusiones</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->bruises) }}</td>
    </tr>
    <tr>
        <td>Fracturas</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->fractures) }}</td>
    </tr>
    <tr>
        <td>Lesiones Musculares</td>
        <td>{{ \App\Models\MedicalRecord::conditionStatus($user->medical_record->muscle_injuries) }}</td>
    </tr>
    <tr>
        <td>Fuma</td>
        <td>{{ ($user->medical_record->tobacco)?'Si':'No' }}</td>
    </tr>
    <tr>
        <td>Bebe</td>
        <td>{{ ($user->medical_record->alcohol)?'Si':'No' }}</td>
    </tr>
    <tr>
        <td>Otros</td>
        <td>{{ $user->medical_record->others }}</td>
    </tr>
    </tr>
    </tbody>
</table>