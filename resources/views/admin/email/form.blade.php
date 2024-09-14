<!DOCTYPE html>
<html>

    <head>
        <title>{{ $subject }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                margin: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #ddd;
            }

            th,
            td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f4f4f4;
                text-align: center;
            }

            td {
                text-align: center;
            }

            .text-end {
                text-align: right;
            }

            .text-muted {
                color: #888;
            }

            .fw-semibold {
                font-weight: 600;
            }

            .fw-medium {
                font-weight: 500;
            }

            .fs-sm {
                font-size: 14px;
            }

            .mt-1 {
                margin-top: 0.5rem;
            }
        </style>
    </head>

    <body>

        <!-- Client Information Table -->
        <div style="margin-bottom: 20px;">
            <h3 style="margin-bottom: 10px; font-size: 18px; font-weight: bold;">{{ $subject }}</h3>
            <table>
                {{Log::info($details)}}
                <thead>
                    <tr>
                        <th>{{ __("string.name") }}</th>
                        <th>{{ __("string.email") }}</th>
                        <th>{{ __("string.phone") }}</th>
                        <th>{{ __("string.subject") }}</th>
                        <th>{{ __("string.message") }}</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="#" style="color: #1a73e8; text-decoration: none;">{{ $details["name"] }}</a>
                        </td> <td>
                            <a href="#" style="color: #1a73e8; text-decoration: none;">{{ $details["email"] }}</a>
                        </td>
                        <td>
                            <a href="#" style="color: #1a73e8; text-decoration: none;">{{ $details["phone"] }}</a>
                        </td>
                        <td>
                            <a href="#"
                                style="color: #1a73e8; text-decoration: none;">{{ $details["subject"] }}</a>
                        </td>
                        <td>
                            <a href="#"
                                style="color: #1a73e8; text-decoration: none;">{{ $details["message"] }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </body>

</html>
