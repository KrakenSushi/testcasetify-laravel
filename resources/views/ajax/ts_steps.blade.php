@foreach($testSteps as $item)
<tr>
  <td class="text-center"><span class="fw-bolder fs-3 step" id="step$row[step_num]">{{ $item -> step_num }}</span><br>
  <button type="button" class="btn btn-link text-danger btnDeleteRow"><i class="fas fa-trash"></i></button> </td>
  <td><textarea name="ts" rows="3" class="form-control modalField ts">{{ $item -> test_step }}</textarea></td>
  <td><textarea name="td" rows="3" class="form-control modalField td">{{ $item -> test_data }}</textarea></td>
  <td><textarea name="er" rows="3" class="form-control modalField er">{{ $item -> expected_result }}</textarea></td>
  <td><textarea name="ar" rows="3" class="form-control modalField ar">{{ $item -> actual_result }}</textarea></td>
  <td>
  <input type="text" name="status" class="selectStatus d-none" value="{{ $item -> status }}">
    <div class="btn btn-outline-success py-4 mx-4 fs-4 fw-bolder text-uppercase selectStatusBtn">Pass</div>
  </td>
</tr>
@endforeach