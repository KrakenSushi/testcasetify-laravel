<div class="table-responsive">
    <table class="table mt-0">
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">Test Case Number </th>
            <th>Test Case Title</th>	
            <th>Module Name</th>
            <th style="width: 15%;"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($testCases as $item)
        <tr class="text-center">
            <td>{{ $item -> tc_num }}</td>
            <td>{{ $item -> tc_title }}</td>
            <td>{{ $item -> tc_module_name }}</td>
            <td>
                <a href="/print?tc={{ $item -> id }}" class="btn btn-primary btnDeleteTC" target="_blank"><i class="fas fa-print"></i>  Print</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>