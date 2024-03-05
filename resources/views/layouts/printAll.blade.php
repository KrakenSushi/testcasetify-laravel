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

    @foreach ($testCase as $item)
    <table>
        <thead>
            <tr>
                <td style="text-align: left;" colspan="6">
                    <span style="font-weight: bold;">Test Case Title: </span><span>{{ $item -> tc_title }}</span>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Case No:  </span><span>{{ $item -> tc_num }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Case Designed By:  </span><span>{{ $item -> tc_des_by }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Priority:  </span><span>{{ $item -> tc_priority }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Design Date:  </span><span>{{ $item -> tc_des_date }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Module Name:   </span><span>{{ $item -> tc_module_name }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Executed By:   </span><span>{{ $item -> tc_exec_by }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Description:   </span><span>{{ $item -> tc_desc }}</span>
                </td>
                <td style="text-align: left;" colspan="3">
                    <span style="font-weight: bold;">Test Executed Date:   </span><span>{{ $item -> tc_exec_date }}</span>
                </td>
            </tr>

            <tr>
                <td style="text-align: left;" colspan="6">
                    <span style="font-weight: bold;">Pre-Condition:   </span><span>{{ $item-> tc_precon }}</span>
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
            {{-- @if($testStep-> ) --}}
            @foreach ($testSteps as $steps)
                @if($steps -> test_case_id == $item -> id)
                    <tr>
                        <td>
                            <!-- Step -->
                            {{ $steps -> step_num }}
                        </td>
                        <td>
                            <!-- Test Step -->
                            {{ $steps -> test_step }}
                        </td>
                        <td>
                            <!-- Test Data -->
                            {{ $steps -> test_data }}
                        </td>
                        <td>
                            <!-- Expected Result -->
                            {{ $steps -> expected_result }}
                        </td>
                        <td>
                            <!-- Actual Result -->
                            {{ $steps -> actual_result }}
                        </td>
                        <td>
                            <!-- Status -->
                            @if($steps -> status == 'Pass')
                                <span style="font-weight: bold; color: green;">PASS</span>
                            @else
                                <span style="font-weight: bold; color: red;">FAIL</span>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            <!-- End of test steps -->
            <tr>
                <td style="text-align: left;" colspan="6">
                    <span style="font-weight: bold;">Post-Condition:   </span><span>{{ $item -> tc_postcon }}</span>
                </td>
            </tr>
        </tbody>
    </table>
        <br><br>
    @endforeach

</body>
</html>