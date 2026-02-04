<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>

<h2>Application Acknowledgement Slip</h2>

<p><b>Acknowledgement No:</b> {{ $applicant->acknowledgement_no }}</p>
<p>
    <b>Submitted On:</b>
    {{ $applicant->submitted_at
        ? \Carbon\Carbon::parse($applicant->submitted_at)->format('d-m-Y')
        : '-' }}
</p>

<table>
    <tr><td>Name</td><td>{{ $applicant->user->name }}</td></tr>
    <tr><td>DOB</td><td>{{ $applicant->dob }}</td></tr>
    <tr><td>Category</td><td>{{ strtoupper($applicant->category) }}</td></tr>
    <tr><td>Mobile</td><td>{{ $applicant->mobile }}</td></tr>
</table>

<p style="margin-top:20px;">
    This is a system generated acknowledgement.
</p>

</body>
</html>
