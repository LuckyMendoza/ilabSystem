
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title class="text-center">Divine Grace Medical Clinic</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    .underline { text-decoration: overline ;
    }
   
  </style>
  
 
<body>
    <h3 class="text-center fw-bold">DIVINE GRACE CLINICAL LABORATORY</h3>
    <h6 class="text-center">Plaza Center Bldg. Sto. Nino St. Ibaba East Calapan City</h6>
    <h6 class="text-center">PLDT Tel. No. (043) 748 6927</h6>
    <h6 class="text-center">"THE CLINICAL LABORATORY WITH A QUALITY PERFROMANCE"</h6>
    <hr style=" border: 1px solid black;">
    <h4 class="text-center fw-bold">Blood Chem</h3>
  <table class="w-100 mt-2">
    <tr>
      <td class="w-50">Date: {{ $araw }}</td>
      <td class="w-50">Physician: {{ $doc }}</td>
    </tr>
  </table>
  <table class="w-100 mt-3 mb-2">
    <tr>
      <td class="w-50">Patient: {{ $pangalan }}</td>
   
      <td>Gender: {{ $gender }}</td>

    </tr>
  </table>
  
{{--     
    <table class="table table-bordered custom-table text-sm">
        <tr>    
            <th>Examination</th> 
            <th>Reference Value </th>
            <th>Description</th>
            <th>Result</th>
            <th>Examination</th> 
            <th>Reference Value </th>
            <th>Result</th>
        </tr>
        <tr>
            <th>Glucose</th>
            <td></td>
            <td></td>
            <td>{{ $result->glucose ? $result->glucose : '' }}</td>
            <th>SGOT</th>       
            <td></td>
            <td>{{ $result->sgot ? $result->sgot : ''}}</td>  
          </tr>
          <tr>
            <th>Cholesterol</th>
            <td></td>
            <td></td>
            <td>{{ $result->choles ? $result->choles : '' }}</td>
            <th></th>       
            <td></td>
            <td></td>  
          </tr>
          <tr>
            <th>Blood Uric Acid</th>
            <td></td>
            <td></td>
            <td>{{ $result->bua ? $result->bua : '' }}</td>
            <th>Calcuim</th>       
            <td></td>
            <td>{{ $result->cal ? result->cal : '' }}</td>  
          </tr>
          <tr>
            <th>Blood Urea Nitrogen</th>
            <td></td>
            <td></td>
            <td>{{ $result->bun ? $result->bun : '' }}</td>
            <th>Chloride</th>       
            <td></td>
            <td>{{ $result->chl ? $result->chl : '' }}</td>  
          </tr>
          
    </table> --}}


    <table class="table table-bordered custom-table text-sm">
      <tr>    
          <th>Examination</th> 
          <th>Reference Value</th>
          <th>Description</th>
          <th>Result</th>
          <th>Examination</th> 
          <th>Reference Value</th>
          <th>Result</th>
      </tr>
      <tr>
          <th>Glucose</th>
          <td></td>
          <td></td>
          <td id="glucose">{{ isset($result->glucose) ? $result->glucose : '' }}</td>
          <th>SGOT</th>       
          <td></td>
          <td>{{ isset($result->sgot) ? $result->sgot : '' }}</td>  
      </tr>
      <tr>
          <th>Cholesterol</th>
          <td></td>
          <td></td>
          <td>{{ isset($result->choles) ? $result->choles : '' }}</td>
          <th></th>       
          <td></td>
          <td></td>  
      </tr>
      <tr>
          <th>Blood Uric Acid</th>
          <td></td>
          <td></td>
          <td>{{ isset($result->bua) ? $result->bua : '' }}</td>
          <th>Calcuim</th>       
          <td></td>
          <td>{{ isset($result->cal) ? $result->cal : '' }}</td>  
      </tr>
      <tr>
          <th>Blood Urea Nitrogen</th>
          <td></td>
          <td></td>
          <td>{{ isset($result->bun) ? $result->bun : '' }}</td>
          <th>Chloride</th>       
          <td></td>
          <td>{{ isset($result->chl) ? $result->chl : '' }}</td>  
      </tr>
  </table>
  <table class="w-100 mt-2">
    <tr>
      <td>
        <p>Analyzed by:</p>
        <p ><b class="">Annaline D. Alferez,RMT</b><br>Medical Technologist<br>Lic.No. 0104373</p>
      </td>
      <td>
        <p>Verified by:</p>
        <p ><b class="">ELBERT R. DALISAY, RMT</b><br>Medical Technologist<br>Lic.No. 0030409</p>
      </td>
      <td>
        <p>Noted by:</p>
        <p ><b class="">Dr. Anacleta Valdez ,MHA, FPSP</b><br>Medical Technologist<br>Lic.No. 0066916</p>
      </td>
    </tr>
  </table>
  <script>
  </script>
</body>
</html>