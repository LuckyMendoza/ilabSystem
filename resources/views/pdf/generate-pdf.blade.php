<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title class="text-center">Divine Grace Medical Clinic</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3 class="text-center fw-bold">DIVINE GRACE CLINICAL LABORATORY</h3>
    <h6 class="text-center">Plaza Center Bldg. Sto. Nino St. Ibaba East Calapan City</h6>
    <h6 class="text-center">PLDT Tel. No. (043) 748 6927</h6>
    <hr>
    <p>Date: {{ $date }}</p>
    <p>Patient: {{ $patient_firstname . ' ' . $patient_lastname }}</p>
    <p>Physician: {{ $patient_firstname . ' ' . $patient_lastname }}</p>
    <p>Gender: {{ $gender }}</p>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>Examination</th>
            <th>Result</th>
        </tr>
        <tr>
            <td>{{ $service }}</td>
            <td>{{ $prescription }}</td>
        </tr>
    </table>
</body>
</html>

{{-- 'date' => $query->schedule_date,
            'patient_firstname' => $query->patient->fname,
            'patient_lastname' => $query->patient->lname,
            'gender' => $query->patient->gender,
            'birthday' => $query->patient->birthdate,
            'service' => $query->services->service_name,
            'prescription' => $query->prescription->result --}}