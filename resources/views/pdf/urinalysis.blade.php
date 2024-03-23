
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
    <h6 class="text-center">"THE CLINICAL LABORATORY WITH A QUALITY PERFROMANCE"</h6>
    <hr style=" border: 1px solid black;">
    <h4 class="text-center fw-bold">Urinalysis</h3><br><br>

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
        
    
    <table class="table table-bordered">
        <tr>
            <th colspan="2" class="text-center">Macroscopic</th>
            <th colspan="2" class="text-center">Microscopic</th>
        </tr>
        <tr>    
            <th>Description</th> 
       
            <th>Result</th>
            <th>Description</th>
 
            <th>Result</th>
        </tr>
        <tr>
            <th>Sugar</th>
            <td id="sugar">{{ $result->sugar ? $result->sugar : '' }}</td>
            <th>A.Urates/phosphates</th>
            <td id="phosphates">{{ $result->phospates ? $result->phospates : '' }}</td>
            
          </tr>
          <tr>
            <th>Blood</th>
            <td id="blood">{{ $result->blood ? $result->blood : '' }}</td>
            <th></th>
            <td></td>
            
          </tr>
          <tr>
            <th>Ketones</th>
            <td id="ketones">{{ $result->ketones ? $result->ketones : '' }}</td>
            <th></th>
            <td></td>
            
          </tr>
        
          
    </table>
    <table class="w-100 mt-2">
    <tr>
      <td>
        <p>Analyzed by:</p>
        <p ><b class="underline">{{$doc}}</b><br>Medical Technologist<br>Lic.No. 0104373</p>
      </td>
      <td>
        <p>Verified by:</p>
        <p ><b class="underline">{{$doc}}</b><br>Medical Technologist<br>Lic.No. 0030409</p>
      </td>
      <td>
        <p>Noted by:</p>
        <p ><b class="underline">{{$doc}}</b><br>Medical Technologist<br>Lic.No. 0066916</p>
      </td>
    </tr>
  </table>
</body>
</html>a