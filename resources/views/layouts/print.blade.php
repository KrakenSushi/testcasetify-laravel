<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="icon" type="image/png" href="{{ asset('assets/img/checklist.svg') }}">
    <style>
        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
            padding: 5px;
        }
        table{
            width: 100%;
        }
        tbody tr td{
            text-align: center;
        }
    </style>
</head>
<body>

    <h1 style="font-weight:bold;">Project: {{ $project['project_name'] }} </h1>

    <table>
        <thead>
            <tr>
                <td style="text-align: left;" colspan="6">
                    <span style="font-weight: bold;">Test Case Title: </span><span>{{ $testCase['tc_title'] }}</span>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Case No:  </span><span>{{ $testCase['tc_num'] }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Case Designed By:  </span><span>{{ $testCase['tc_des_by'] }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Priority:  </span><span>{{ $testCase['tc_priority'] }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Design Date:  </span><span>{{ $testCase['tc_des_date'] }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Module Name:   </span><span>{{ $testCase['tc_module_name'] }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Executed By:   </span><span>{{ $testCase['tc_exec_by'] }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Description:   </span><span>{{ $testCase['tc_desc'] }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Executed Date:   </span><span>{{ $testCase['tc_exec_date'] }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="6">
                    <span style="font-weight: bold;">Pre-Condition:   </span><span>{{ $testCase['tc_precon'] }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <span style="font-weight: bold;">Step</span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: bold;">Test Step</span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: bold;">Test Data</span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: bold;">Expected Result</span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: bold;">Actual Result</span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: bold;">Status</span>
                </td>
            </tr>
            <!-- Insert test steps here -->
            @foreach ($testSteps as $item)
            <tr>
                <td>
                    <!-- Step -->
                    {{ $item -> step_num }}
                </td>
                <td>
                    <!-- Test Step -->
                    {{ $item -> test_step }}
                </td>
                <td>
                    <!-- Test Data -->
                    {{ $item -> test_data }}
                </td>
                <td>
                    <!-- Expected Result -->
                    {{ $item -> expected_result }}
                </td>
                <td>
                    <!-- Actual Result -->
                    {{ $item -> actual_result }}
                </td>
                <td>
                    <!-- Status -->
                    @if($item -> status == 'Pass')
                        <span style="font-weight: bold; color: green;">PASS</span>
                    @else
                        <span style="font-weight: bold; color: red;">FAIL</span>
                    @endif
                </td>
            </tr>
            @endforeach
            <!-- End of test steps -->
            <tr>
                <td style="text-align: left;" colspan="6">
                    <span style="font-weight: bold;">Post-Condition:   </span><span>{{ $testCase['tc_postcon'] }}</span>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>